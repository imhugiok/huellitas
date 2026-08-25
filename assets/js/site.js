/**
 * Mejora progresiva. Sin JS la pagina se ve y se lee completa; esto solo
 * agrega dos cosas: aparicion suave al hacer scroll y marcar en que seccion
 * va el lector dentro del indice.
 */

(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* --- Aparicion al entrar en pantalla ------------------------------- */

    function activarRevelado() {
        if (reduceMotion || !('IntersectionObserver' in window)) {
            return;
        }

        var objetivos = document.querySelectorAll(
            '.seccion__cabecera, .prosa, .actividad, .jornada, .articulo, ' +
            '.pregunta, .tabla-envoltura, .aliados__grupo, .pendientes'
        );

        if (!objetivos.length) {
            return;
        }

        // Se marca aqui y no en el HTML: si el JS falla, nada queda invisible.
        document.body.classList.add('js-movimiento');

        var observador = new IntersectionObserver(function (entradas) {
            entradas.forEach(function (entrada) {
                if (!entrada.isIntersecting) {
                    return;
                }
                entrada.target.classList.add('visible');
                observador.unobserve(entrada.target);
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

        // El escalonado se hace en CSS (nth-child) para no escribir estilos
        // en linea: asi la CSP puede prohibir style-src 'unsafe-inline'.
        Array.prototype.forEach.call(objetivos, function (nodo) {
            nodo.classList.add('revelar');
            observador.observe(nodo);
        });
    }

    /* --- Seccion activa en el indice ----------------------------------- */

    function activarIndice() {
        var enlaces = document.querySelectorAll('.indice__enlace');

        if (!enlaces.length || !('IntersectionObserver' in window)) {
            return;
        }

        var porId = {};

        Array.prototype.forEach.call(enlaces, function (enlace) {
            var href = enlace.getAttribute('href');

            // Las entradas que llevan a otra pagina no participan: si no, un
            // href="/galeria" acababa marcando la seccion #galeria de aqui.
            if (href.charAt(0) !== '#') {
                return;
            }

            var seccion = document.getElementById(href.slice(1));

            if (seccion) {
                porId[href.slice(1)] = enlace;
            }
        });

        var visibles = [];

        var observador = new IntersectionObserver(function (entradas) {
            entradas.forEach(function (entrada) {
                var id = entrada.target.id;
                var pos = visibles.indexOf(id);

                if (entrada.isIntersecting && pos === -1) {
                    visibles.push(id);
                } else if (!entrada.isIntersecting && pos !== -1) {
                    visibles.splice(pos, 1);
                }
            });

            Array.prototype.forEach.call(enlaces, function (enlace) {
                enlace.removeAttribute('aria-current');
            });

            var activa = visibles[0];

            if (activa && porId[activa]) {
                porId[activa].setAttribute('aria-current', 'true');
            }
        }, { rootMargin: '-20% 0px -70% 0px' });

        Object.keys(porId).forEach(function (id) {
            observador.observe(document.getElementById(id));
        });
    }

    /* --- Canal lateral: en que actividad va el lector -------------------- */

    function activarCanal() {
        var enlaces = document.querySelectorAll('.canal__enlace');

        if (!enlaces.length || !('IntersectionObserver' in window)) {
            return;
        }

        var entradas = [];

        Array.prototype.forEach.call(enlaces, function (enlace) {
            var destino = document.getElementById(enlace.getAttribute('href').slice(1));

            if (destino) {
                entradas.push({ enlace: enlace, item: enlace.parentNode, destino: destino });
            }
        });

        if (!entradas.length) {
            return;
        }

        var visibles = [];

        function pintar() {
            var activa = entradas.length;

            entradas.forEach(function (entrada, i) {
                if (visibles.indexOf(entrada.destino.id) !== -1 && i < activa) {
                    activa = i;
                }
            });

            entradas.forEach(function (entrada, i) {
                if (i === activa) {
                    entrada.enlace.setAttribute('aria-current', 'true');
                } else {
                    entrada.enlace.removeAttribute('aria-current');
                }

                // "Visto" es todo lo que queda por encima de la activa.
                entrada.item.classList.toggle('canal__item--visto', i < activa);
            });
        }

        var observador = new IntersectionObserver(function (cambios) {
            cambios.forEach(function (cambio) {
                var id = cambio.target.id;
                var pos = visibles.indexOf(id);

                if (cambio.isIntersecting && pos === -1) {
                    visibles.push(id);
                } else if (!cambio.isIntersecting && pos !== -1) {
                    visibles.splice(pos, 1);
                }
            });

            pintar();
        }, { rootMargin: '-15% 0px -55% 0px' });

        entradas.forEach(function (entrada) {
            observador.observe(entrada.destino);
        });
    }

    /* --- Visor de fotos -------------------------------------------------- */

    function activarVisor() {
        var visor = document.querySelector('.visor');

        if (!visor || typeof visor.showModal !== 'function') {
            return; // Sin <dialog>: los enlaces abren el archivo, como siempre.
        }

        var foto     = visor.querySelector('.visor__foto');
        var cerrar   = visor.querySelector('.visor__cerrar');
        var previa   = visor.querySelector('.visor__flecha--previa');
        var siguiente = visor.querySelector('.visor__flecha--siguiente');
        var cuenta   = visor.querySelector('.visor__cuenta');

        // Las flechas se mueven dentro de la jornada abierta, no por toda la
        // pagina: pasar del ultimo boli al primer perro no tendria sentido.
        var lista = [];
        var actual = 0;

        function pintar() {
            var enlace = lista[actual];

            foto.src = enlace.getAttribute('href');
            foto.alt = enlace.getAttribute('data-visor') || '';

            previa.disabled = actual === 0;
            siguiente.disabled = actual === lista.length - 1;

            if (cuenta) {
                cuenta.textContent = lista.length > 1
                    ? (actual + 1) + ' / ' + lista.length
                    : '';
            }
        }

        function mover(paso) {
            var destino = actual + paso;

            if (destino < 0 || destino >= lista.length) {
                return;
            }

            actual = destino;
            pintar();
        }

        document.addEventListener('click', function (evento) {
            var enlace = evento.target.closest('.cuadricula__foto');

            if (!enlace || evento.metaKey || evento.ctrlKey || evento.shiftKey || evento.button !== 0) {
                return;
            }

            evento.preventDefault();

            var grupo = enlace.closest('.jornada') || enlace.closest('.cuadricula') || document;
            lista = Array.prototype.slice.call(grupo.querySelectorAll('.cuadricula__foto'));
            actual = lista.indexOf(enlace);

            pintar();
            visor.showModal();
        });

        cerrar.addEventListener('click', function () { visor.close(); });
        previa.addEventListener('click', function () { mover(-1); });
        siguiente.addEventListener('click', function () { mover(1); });

        visor.addEventListener('keydown', function (evento) {
            if (evento.key === 'ArrowLeft') {
                evento.preventDefault();
                mover(-1);
            } else if (evento.key === 'ArrowRight') {
                evento.preventDefault();
                mover(1);
            }
        });

        // Clic fuera de la foto: el <dialog> ocupa justo la caja de la imagen,
        // asi que cualquier clic sobre el propio dialog es "fuera".
        visor.addEventListener('click', function (evento) {
            if (evento.target === visor) {
                visor.close();
            }
        });

        // Soltar la imagen al cerrar para no dejarla en memoria.
        visor.addEventListener('close', function () {
            foto.removeAttribute('src');
            lista = [];
        });
    }

    /* --- Desplazamiento suave a las anclas ------------------------------ */

    function activarAnclas() {
        if (reduceMotion) {
            return;
        }

        document.addEventListener('click', function (evento) {
            var enlace = evento.target.closest('a[href^="#"]');

            if (!enlace || enlace.getAttribute('href') === '#' || evento.defaultPrevented) {
                return;
            }

            var destino = document.getElementById(enlace.getAttribute('href').slice(1));

            if (!destino) {
                return;
            }

            evento.preventDefault();
            destino.scrollIntoView({ behavior: 'smooth', block: 'start' });

            // El foco tiene que seguir al scroll o el teclado se queda arriba.
            destino.setAttribute('tabindex', '-1');
            destino.focus({ preventScroll: true });

            if (history.replaceState) {
                history.replaceState(null, '', enlace.getAttribute('href'));
            }
        });
    }

    activarRevelado();
    activarIndice();
    activarCanal();
    activarVisor();
    activarAnclas();
}());

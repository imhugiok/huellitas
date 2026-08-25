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
            '.seccion__cabecera, .seccion__entradilla, .prosa, .actividad, ' +
            '.tabla-envoltura, .nota-numeros, .aliados__grupo, .pendientes'
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
            var id = enlace.getAttribute('href').slice(1);
            var seccion = document.getElementById(id);

            if (seccion) {
                porId[id] = enlace;
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

    /* --- Desplazamiento suave a las anclas ------------------------------ */

    function activarAnclas() {
        if (reduceMotion) {
            return;
        }

        document.addEventListener('click', function (evento) {
            var enlace = evento.target.closest('a[href^="#"]');

            if (!enlace || enlace.getAttribute('href') === '#') {
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
    activarAnclas();
}());

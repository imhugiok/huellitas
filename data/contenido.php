<?php
/**
 * Fuente unica de verdad del sitio.
 *
 * REGLA: aqui no se inventa nada. Cada cifra lleva su estado y, cuando existe,
 * su fuente. Si un dato no esta respaldado va en 'estimado', nunca en
 * 'confirmado'. Editar este archivo es editar la pagina: las plantillas de
 * /partials no contienen texto de contenido.
 *
 * Sincronizado con huellitas-al-corazon.md del 24 de agosto de 2026.
 */

declare(strict_types=1);

return [

    'sitio' => [
        'nombre'      => 'Huellitas al Corazón',
        'dominio'     => 'huellitas.hugorivera.me',
        'url'         => 'https://huellitas.hugorivera.me/',
        'titulo'      => 'Huellitas al Corazón — Proyecto de bienestar animal en Guadalajara',
        'descripcion' => 'Proyecto de bienestar animal fundado en Guadalajara en septiembre de 2025. '
                       . 'Apoyo a refugios, adopción responsable y concientización. '
                       . 'Actividades documentadas y fechadas.',
        'idioma'      => 'es-MX',
        'og_imagen'   => 'assets/img/og.png',
    ],

    'hero' => [
        'titulo'    => 'Huellitas al Corazón',
        'subtitulo' => 'Proyecto de bienestar animal en Guadalajara, Jalisco. Fundado en septiembre de 2025.',
    ],

    'que_es' => [
        'titulo'   => 'Qué es',
        'parrafos' => [
            'Huellitas al Corazón enfrenta el abandono animal en Guadalajara desde tres frentes: '
            . 'apoyo material a refugios, fomento de la adopción responsable y concientización sobre '
            . 'el cuidado que merecen los animales.',
            'No es un proyecto de medio ambiente. Es bienestar animal, y es una categoría distinta.',
        ],
    ],

    'actividades' => [
        'titulo' => 'Qué se hizo',

        // Marcador visible cuando falta la foto de un bloque. Ponlo en false
        // si prefieres que el hueco no se note mientras consigues las imágenes.
        'mostrar_anexos_pendientes' => false,

        'items' => [
            [
                'id'        => 'investigacion',
                'corto'     => 'Investigación',
                'titulo'    => 'Investigación de campo en refugios',
                'fecha'     => 'Septiembre de 2025',
                'fecha_iso' => '2025-09',
                'texto'     => 'Visitas a refugios para levantar información directa: qué necesitaban, cuáles '
                             . 'eran los problemas más comunes de los perros en calle y cómo terminaban ahí. '
                             . 'Sirvió de diagnóstico para decidir en qué apoyar.',
                'imagenes'  => [
                    [
                        'archivo' => 'investigacion-refugios',
                        'alt'     => 'Camada de cachorros dentro de una jaula del refugio, junto a un '
                                   . 'comedero metálico.',
                        'pie'     => 'Así se ve el refugio por dentro. De estas visitas salió la lista de '
                                   . 'lo que hacía falta: alimento, limpieza y espacio.',
                    ],
                ],
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DO4olIcjNyP/', 'texto' => 'Primera visita al refugio'],
                    ['url' => 'https://www.instagram.com/p/DPK4X-bjIAL/', 'texto' => 'Segunda visita al refugio'],
                ],
            ],
            [
                'id'        => 'feria',
                'corto'     => 'Venta con causa',
                'titulo'    => 'Venta con causa en una feria',
                'fecha'     => '17 de septiembre de 2025',
                'fecha_iso' => '2025-09-17',
                'texto'     => 'Venta de bolis hecha personalmente para recaudar fondos, entregados directo '
                             . 'al refugio.',
                'imagenes'  => [
                    [
                        'archivo' => 'venta-bolis-qr',
                        'alt'     => 'Boli con una etiqueta que lleva un código QR y la dirección '
                                   . 'byhugiok.com, sostenido por un comprador.',
                        'pie'     => 'Cada boli iba con su etiqueta y un QR a la página del proyecto, que '
                                   . 'entonces vivía en byhugiok.com.',
                    ],
                    [
                        'archivo' => 'venta-bolis',
                        'alt'     => 'Hielera abierta llena de bolis durante la venta en la escuela.',
                        'pie'     => 'La hielera en plena venta. Los bolis se hicieron a mano; lo '
                                   . 'recaudado se entregó al refugio.',
                    ],
                ],
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DO2NyJ3DDkn/', 'texto' => 'Publicación de la venta'],
                ],
            ],
            [
                'id'        => 'croquetas',
                'corto'     => 'Donación',
                'titulo'    => 'Campaña de donación de croquetas',
                'fecha'     => '3 de octubre de 2025',
                'fecha_iso' => '2025-10-03',
                'texto'     => 'Caja de acopio en la escuela para que quien quisiera dejara croqueta. '
                             . 'Lo recolectado se entregó directo a los refugios.',
                'imagenes'  => [
                    [
                        'archivo' => 'donacion-croquetas',
                        'alt'     => 'Caja de acopio con un letrero hecho a mano que dice Donación de '
                                   . 'croquetas, con bolsas de alimento para perro adentro.',
                        'pie'     => 'La caja de acopio con lo que se juntó. El letrero está hecho a mano: '
                                   . 'no hubo presupuesto para nada más.',
                    ],
                ],
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DPX-j8cgF0Y/', 'texto' => 'Publicación de la campaña'],
                ],
            ],
            [
                'id'        => 'yoga',
                'corto'     => 'Evento de yoga',
                'titulo'    => 'Evento de adopción responsable',
                'fecha'     => '16 de octubre de 2025',
                'fecha_iso' => '2025-10-16',
                'texto'     => 'Clase de yoga en el claustro de Tecmilenio Guadalajara Sur, con perros del '
                             . 'refugio caminando entre los participantes. Organizado junto al estudio '
                             . '@arboldelyogalasfuentes.',
                'imagenes'  => [
                    [
                        'archivo' => 'evento-yoga',
                        'alt'     => 'Cachorro con collar rojo caminando entre las piernas de los asistentes al evento.',
                        'pie'     => 'La idea era que la gente conviviera con los perros antes de decidir, '
                                   . 'no que los viera en una jaula.',
                    ],
                ],
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DP8UTm0DYXV/', 'texto' => 'Publicación del evento'],
                ],
            ],
            [
                'id'        => 'entregas',
                'corto'     => 'Entregas',
                'titulo'    => 'Entregas recurrentes a refugios',
                'fecha'     => 'Actividad recurrente',
                'fecha_iso' => null,
                'texto'     => 'Visitas repetidas llevando croqueta, artículos de limpieza y los fondos '
                             . 'recaudados.',
                'imagenes'  => [
                    [
                        'archivo' => 'entregas-compra',
                        'alt'     => 'Pasillo de una tienda con estantes de croqueta durante la compra de insumos.',
                        'pie'     => 'La compra. Croqueta, agua y material de limpieza elegidos según lo que '
                                   . 'pidió el refugio.',
                    ],
                    [
                        'archivo' => 'entregas-insumos',
                        'alt'     => 'Bolsas de croqueta, detergente, vinagre y una escoba sobre una mesa, listos para entregar.',
                        'pie'     => 'Lo que se entregó. En estas fotos se alcanzan a contar 6 kg de croqueta; '
                                   . 'el total de todas las entregas no quedó registrado.',
                    ],
                ],
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/huellitasalcorazon.gdl/p/DO1qByHkvPk/', 'texto' => 'Publicación de entrega'],
                ],
            ],
        ],
    ],

    'numeros' => [
        'titulo' => 'Números',

        // Encabezados de la tabla. Deja 'nota' en null si no quieres subtítulo.
        'cabeceras' => [
            'metrica'    => ['titulo' => 'Métrica',    'nota' => null],
            'confirmado' => ['titulo' => 'Confirmado', 'nota' => null],
            'estimado'   => ['titulo' => 'Estimado',   'nota' => null],
        ],
        'filas' => [
            [
                'metrica'    => 'Refugios apoyados',
                'confirmado' => '2',
                'estimado'   => null,
                'fuente'     => null,
            ],
            [
                'metrica'    => 'Adopciones',
                'confirmado' => '2',
                'estimado'   => 'Probablemente más',
                'fuente'     => 'Las 2 salieron del evento de adopción responsable del 16 de octubre y '
                              . 'están confirmadas: @propatitasgdl nos mencionó en una historia y la '
                              . 'reposteamos. Hubo 2 historias más del refugio que no reposteé y se '
                              . 'perdieron.',
            ],
            [
                'metrica'    => 'Croqueta entregada',
                'confirmado' => '6 kg',
                'estimado'   => null,
                'fuente'     => 'Los 6 kg se alcanzan a contar en las fotos de la compra. El total de todas '
                              . 'las entregas se desconoce: no llevé registro y falta la constancia del refugio.',
            ],
            [
                'metrica'    => 'Insumos y artículos de limpieza',
                'confirmado' => 'Entregas recurrentes',
                'estimado'   => null,
                'fuente'     => 'Documentadas en publicaciones y fotos. Sin conteo respaldado.',
            ],
            [
                'metrica'    => 'Publicaciones documentadas',
                'confirmado' => '11',
                'estimado'   => null,
                'fuente'     => 'Incluye 2 publicaciones que entraron por una colaboración aceptada en '
                              . 'agosto de 2026.',
            ],
            [
                'metrica'    => 'Seguidores en Instagram',
                'confirmado' => '124',
                'estimado'   => null,
                'fuente'     => 'Hoy. Durante el periodo activo la cuenta llegó a 221; la caída es de los '
                              . 'meses de pausa.',
            ],
            [
                'metrica'    => 'Fondos recaudados',
                'confirmado' => null,
                'estimado'   => null,
                'fuente'     => 'Sin dato. No llevé registro de las cantidades.',
            ],
            [
                'metrica'    => 'Perros rescatados directamente',
                'confirmado' => '0',
                'estimado'   => null,
                'fuente'     => 'El trabajo fue de apoyo a refugios, no de rescate en calle.',
            ],
            [
                'metrica'    => 'Duración de la primera etapa',
                'confirmado' => '~5 meses',
                'estimado'   => null,
                'fuente'     => 'Septiembre de 2025 a febrero de 2026, por las fechas de las publicaciones.',
            ],
        ],
    ],

    'galeria' => [
        'titulo'      => 'Galería',
        'entradilla'  => 'Todas las fotos del proyecto, por jornada y con su fecha original.',
        'descripcion' => 'Archivo fotográfico de Huellitas al Corazón: venta de bolis, visitas al '
                       . 'refugio, campaña de donación de croquetas y evento de adopción responsable.',
        'enlace_completa' => 'Ver todas las fotos',

        // Las fotos NO se listan aqui: se leen de /assets/img/galeria/<id>.
        // Para agregar mas, deja el archivo en la carpeta que toque.
        'grupos' => [
            [
                'id'        => 'bolis',
                'corto'     => 'Venta de bolis',
                'titulo'    => 'Venta de bolis en Tecmilenio',
                'fecha'     => '17 de septiembre de 2025',
                'fecha_iso' => '2025-09-17',
                'texto'     => 'La vendimia con causa. Los bolis se prepararon y se vendieron en la escuela; '
                             . 'lo recaudado se entregó al refugio.',
            ],
            [
                'id'        => 'compra',
                'corto'     => 'La compra',
                'titulo'    => 'La compra de los insumos',
                'fecha'     => '25 de septiembre de 2025',
                'fecha_iso' => '2025-09-25',
                'texto'     => 'Con lo recaudado en la venta de bolis se fue a comprar: croqueta, agua, '
                             . 'escobas, vinagre y material de limpieza. Al día siguiente se entregó '
                             . 'todo en el refugio.',
            ],
            [
                'id'        => 'refugio',
                'corto'     => 'Visita al refugio',
                'titulo'    => 'Visita al refugio',
                'fecha'     => '26 de septiembre de 2025',
                'fecha_iso' => '2025-09-26',
                'texto'     => 'La entrega de lo que se compró el día anterior, y cómo se ve el refugio '
                             . 'por dentro: los perros, los comederos y el espacio con el que trabajan.',
            ],
            [
                'id'        => 'croquetas',
                'corto'     => 'Donación',
                'titulo'    => 'Campaña de donación de croquetas',
                'fecha'     => '3 de octubre de 2025',
                'fecha_iso' => '2025-10-03',
                'texto'     => 'La caja de acopio en la escuela y lo que se fue juntando.',
            ],
            [
                'id'        => 'yoga',
                'corto'     => 'Evento de yoga',
                'titulo'    => 'Evento de adopción responsable',
                'fecha'     => '16 de octubre de 2025',
                'fecha_iso' => '2025-10-16',
                'texto'     => 'La clase de yoga en el claustro de Tecmilenio, con los perros del refugio '
                             . 'sueltos entre los participantes.',
            ],
        ],

        // Plantilla del texto alternativo: %1$d es el numero de foto y %2$s
        // el nombre de la jornada en minusculas.
        'alt'  => 'Foto %1$d de la jornada: %2$s.',
        'nota' => 'Las fotos son de mi cámara y están fechadas por el archivo original. '
                . 'Quien aparezca y quiera que se retire su imagen, me escribe y se retira.',
    ],

    'cuidados' => [
        'titulo'      => 'Cuidados',
        'entradilla'  => 'Lo que aprendimos preguntando en los refugios, contado en corto.',
        'descripcion' => 'Guía práctica sobre adopción responsable, qué necesita un refugio y qué '
                       . 'hacer si te encuentras un perro en la calle. Escrita desde el trabajo de '
                       . 'campo de Huellitas al Corazón en Guadalajara.',

        'aviso' => 'Esto no sustituye a un veterinario. Cualquier cosa de salud (vacunas, '
                 . 'desparasitación, esterilización, una herida, un perro que no come) se consulta '
                 . 'con uno, y de preferencia antes de que sea urgente.',

        'articulos' => [
            'titulo' => 'Artículos',
            'items'  => [
                [
                    'id'     => 'lo-que-necesita-un-refugio',
                    'titulo' => 'Lo que de verdad necesita un refugio',
                    'lede'   => 'Antes de decidir en qué apoyar, fuimos a preguntar. Lo que contestaron '
                              . 'no se parece mucho a lo que uno imagina desde afuera.',
                    'parrafos' => [
                        'La idea que uno trae es que un refugio necesita gente que adopte. Y sí, pero eso '
                        . 'es el final de una cadena larga. Cuando preguntamos directamente, lo primero '
                        . 'que salió fue mucho más terrenal: comida, agua limpia y manos.',
                        'Lo que anotamos ese día fue esto. Escasez de vacunación y esterilización, que es '
                        . 'lo que hace que el problema se renueve solo. Falta de recursos básicos: poca '
                        . 'comida, poca agua, pocos baños y poquísimos trabajadores para la cantidad de '
                        . 'animales que hay. E infraestructura limitada: terrenos baldíos y '
                        . 'construcciones que no se hicieron para esto.',
                        'De ahí salió en qué apoyar. No inventamos una necesidad para llenarla: llevamos '
                        . 'croqueta, artículos de limpieza y los fondos que juntamos, porque eso fue lo '
                        . 'que pidieron.',
                        'Si vas a ayudar a un refugio y no sabes por dónde, la respuesta corta es '
                        . 'preguntarles. La lista de cada uno es distinta y cambia con la temporada.',
                    ],
                ],
                [
                    'id'     => 'adoptar-no-es-rescatar',
                    'titulo' => 'Adoptar no es rescatar',
                    'lede'   => 'Son dos cosas distintas, y confundirlas les hace daño a las dos.',
                    'parrafos' => [
                        'Rescatar es sacar a un animal de una situación concreta. Adoptar es hacerse '
                        . 'cargo de uno durante los diez, doce o quince años que le queden. La primera '
                        . 'dura una tarde; la segunda dura más que muchos trabajos.',
                        'Lo decimos porque los eventos de adopción tienen un riesgo: la emoción del '
                        . 'momento. Alguien conoce a un perro, se conmueve y se lo lleva. A las tres '
                        . 'semanas descubre que no tenía dónde dejarlo cuando viaja, o que no había '
                        . 'contado el gasto del veterinario, y el perro vuelve al refugio peor que como '
                        . 'salió, porque ya perdió una casa.',
                        'Por eso en el evento que organizamos la idea no fue enseñar perros en jaulas, '
                        . 'sino que la gente conviviera con ellos un rato largo y sin prisa. Un perro que '
                        . 'te cae bien después de una hora es una decisión más honesta que uno que te dio '
                        . 'ternura en diez segundos.',
                        'Antes de adoptar vale la pena contestarse tres cosas sin trampa: quién lo cuida '
                        . 'cuando no estás, cuánto puedes gastar al mes, y qué haces si el perro resulta '
                        . 'tener un problema de salud caro. Si las tres tienen respuesta, adelante.',
                    ],
                ],
                [
                    'id'     => 'esterilizacion',
                    'titulo' => 'La esterilización es lo que corta el ciclo',
                    'lede'   => 'Todo lo demás alivia. Esto es lo único que baja el número.',
                    'parrafos' => [
                        'Se puede llevar croqueta todas las semanas y el refugio va a seguir igual de '
                        . 'lleno, porque entran más de los que salen. Eso lo vimos en la práctica: la '
                        . 'presión de ingreso supera a las adopciones.',
                        'La esterilización es la única medida que actúa antes y no después. Una perra sin '
                        . 'esterilizar y sus crías pueden convertirse en muchos animales en calle en '
                        . 'pocos años, y ninguno de ellos va a caber en un refugio.',
                        'La objeción que más escuchamos es el costo. Vale la pena buscar: hay campañas '
                        . 'municipales y clínicas que manejan precios sociales, y suelen anunciarse con '
                        . 'poca antelación y menos difusión de la que merecen. Preguntar en el refugio '
                        . 'más cercano suele ser el atajo, porque ellos sí saben cuándo son.',
                    ],
                ],
            ],
        ],

        'preguntas' => [
            'titulo' => 'Preguntas frecuentes',
            'nota'   => 'Son las preguntas que hicimos en la encuesta del proyecto, contestadas con lo '
                      . 'que aprendimos después.',
            'items'  => [
                [
                    'p' => '¿Qué hago si me encuentro un perro en la calle?',
                    'r' => 'Primero míralo de lejos un momento: si está herido, muy asustado o agresivo, '
                         . 'no te acerques solo. Si se deja, revisa si trae collar o placa, porque muchos '
                         . 'perros en calle son perdidos y no abandonados. Publica una foto con la '
                         . 'ubicación en grupos vecinales antes de moverlo de zona: su familia lo está '
                         . 'buscando ahí. Si nadie lo reclama, llama al refugio antes de llevárselo, '
                         . 'porque casi siempre están llenos y necesitan saber.',
                ],
                [
                    'p' => '¿Puedo ayudar si no puedo adoptar?',
                    'r' => 'Sí, y hace falta más de lo que parece. Puedes ser hogar temporal, que es lo '
                         . 'que más descongestiona a un refugio. Puedes llevar croqueta o artículos de '
                         . 'limpieza, que se acaban cada semana. Puedes ir a ayudar un sábado. Y puedes '
                         . 'difundir: una publicación compartida a tiempo consigue adopciones que de otra '
                         . 'forma no pasan.',
                ],
                [
                    'p' => '¿Adoptar es mejor que comprar?',
                    'r' => 'Para el problema del que hablamos, sí: cada adopción libera un lugar en un '
                         . 'refugio que ya está lleno, y cada compra sostiene una demanda que se surte '
                         . 'criando más. Dicho eso, adoptar mal es peor que no adoptar. El punto no es '
                         . 'llevarse uno rápido, es llevarse el correcto y quedárselo.',
                ],
                [
                    'p' => '¿Cuánto cuesta mantener un perro?',
                    'r' => 'Depende del tamaño y de la ciudad, así que cualquier cifra que te diéramos '
                         . 'sería inventada. Lo que sí podemos decirte es qué contar: comida, vacunas al '
                         . 'año, desparasitación, esterilización una vez, y un fondo para el día que se '
                         . 'enferme, que es el gasto que tumba a la gente. Pide precios en dos o tres '
                         . 'veterinarias de tu zona antes de decidir.',
                ],
                [
                    'p' => '¿Qué necesita un perro recién adoptado los primeros días?',
                    'r' => 'Menos de lo que uno cree y más paciencia de la que uno trae. Un rincón propio '
                         . 'donde nadie lo moleste, horarios fijos de comida y paseo, y tiempo. Un perro '
                         . 'que viene de la calle o de un refugio puede tardar semanas en soltarse; que '
                         . 'se esconda los primeros días es normal y no es que no le gustes. La revisión '
                         . 'con el veterinario, en cambio, es de la primera semana.',
                ],
                [
                    'p' => '¿Cómo sé si un refugio es serio?',
                    'r' => 'Te dejan visitar. Te preguntan a ti antes de darte un perro, en vez de '
                         . 'entregártelo de inmediato. Tienen registro de qué animal es cuál. Y te dicen '
                         . 'que no si ven que no encaja. Un refugio que no filtra no te está haciendo un '
                         . 'favor: está moviendo el problema de sitio.',
                ],
            ],
        ],
    ],

    'aliados' => [
        'titulo' => 'Aliados',
        'grupos' => [
            [
                'rol'   => 'Refugios',
                'items' => [
                    ['nombre' => '@patitas_porbimba', 'url' => 'https://www.instagram.com/patitas_porbimba/'],
                    ['nombre' => '@propatitasgdl',    'url' => 'https://www.instagram.com/propatitasgdl/'],
                ],
            ],
            [
                'rol'   => 'Estudio de yoga',
                'items' => [
                    ['nombre' => '@arboldelyogalasfuentes', 'url' => 'https://www.instagram.com/arboldelyogalasfuentes/'],
                ],
            ],
            [
                'rol'   => 'Sede del evento',
                'items' => [
                    ['nombre' => 'Tecmilenio Guadalajara Sur', 'url' => null],
                ],
            ],
        ],
    ],

    'estado' => [
        'titulo'   => 'Estado actual',
        'parrafos' => [
            'Entre febrero y julio de 2026 el proyecto estuvo en pausa. Lo pausé para concentrarme en '
            . '[Estudia](https://estudia.hugorivera.me), una herramienta de estudio con IA que construyo '
            . 'solo: genera material a partir de los documentos del alumno, programa el repaso espaciado '
            . 'y tiene varios modos de juego. Es gratis y se sostiene con donaciones. No podía con los '
            . 'dos al mismo tiempo y preferí decirlo en vez de dejar este colgado sin explicación.',
            'En julio de 2026 lo retomé. La cuenta sigue activa y las alianzas con los dos refugios y '
            . 'el estudio de yoga también.',
        ],
        'pendientes' => [
            'titulo' => 'Lo que falta',
            'items'  => [
                'Constancias por escrito de @patitas_porbimba y @propatitasgdl. Los mensajes ya están '
                . 'enviados; sigo sin respuesta.',
                'Constancia del evento del 16 de octubre, por solicitar a Tecmilenio.',
            ],
        ],
    ],

    'pie' => [
        'autor'         => 'Hugo Rivera',
        'autor_url'     => 'https://hugorivera.me',
        'autor_enlace'  => 'Hugo Rivera — Portafolio',
        'instagram'     => '@huellitasalcorazon.gdl',
        'instagram_url' => 'https://www.instagram.com/huellitasalcorazon.gdl/',
        'lugar'         => 'Guadalajara, Jalisco, México',
        'firma'         => 'Con amor, por Hugo Rivera.',
    ],
];

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
        'titulo'     => 'Qué se hizo',
        'entradilla' => 'Cada actividad está fechada y enlazada a su publicación original en Instagram. '
                      . 'Los enlaces abren la evidencia pública, sin intermediarios.',

        // Marcador visible cuando falta la foto de un bloque. Ponlo en false
        // si prefieres que el hueco no se note mientras consigues las imágenes.
        'mostrar_anexos_pendientes' => true,

        'items' => [
            [
                'id'        => 'investigacion',
                'titulo'    => 'Investigación de campo en refugios',
                'fecha'     => 'Septiembre de 2025',
                'fecha_iso' => '2025-09',
                'texto'     => 'Visitas a refugios para levantar información directa: qué necesitaban, cuáles '
                             . 'eran los problemas más comunes de los perros en calle y cómo terminaban ahí. '
                             . 'Sirvió de diagnóstico para decidir en qué apoyar.',
                'imagenes'  => [],
                'imagen_pendiente' => 'investigacion-refugios',
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DO4olIcjNyP/', 'texto' => 'Primera visita al refugio'],
                    ['url' => 'https://www.instagram.com/p/DPK4X-bjIAL/', 'texto' => 'Segunda visita al refugio'],
                ],
            ],
            [
                'id'        => 'yoga',
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
                'id'        => 'feria',
                'titulo'    => 'Venta con causa en una feria',
                'fecha'     => '2025',
                'fecha_iso' => '2025',
                'texto'     => 'Venta de bolis hecha personalmente para recaudar fondos, entregados directo '
                             . 'al refugio.',
                'imagenes'  => [],
                'imagen_pendiente' => 'venta-bolis',
                'enlaces'   => [
                    ['url' => 'https://www.instagram.com/p/DO2NyJ3DDkn/', 'texto' => 'Publicación de la venta'],
                ],
            ],
            [
                'id'        => 'entregas',
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
        'titulo'     => 'Números',
        'entradilla' => 'Dos lecturas a propósito: lo que un tercero puede corroborar hoy, y mis '
                      . 'estimaciones. Ninguna cifra aparece sin decir de cuál de las dos se trata.',

        // Encabezados de la tabla. Deja 'nota' en null si no quieres subtítulo.
        'cabeceras' => [
            'metrica'    => ['titulo' => 'Métrica',    'nota' => null],
            'confirmado' => ['titulo' => 'Confirmado', 'nota' => 'verificable'],
            'estimado'   => ['titulo' => 'Estimado',   'nota' => null],
        ],
        'filas' => [
            [
                'metrica'    => 'Refugios apoyados',
                'confirmado' => '2',
                'estimado'   => null,
                'fuente'     => 'Confirmado.',
            ],
            [
                'metrica'    => 'Adopciones',
                'confirmado' => '2',
                'estimado'   => 'Probablemente más',
                'fuente'     => 'Las 2 están confirmadas: @propatitasgdl nos mencionó en una historia y la '
                              . 'reposteamos. Hubo 2 historias más del refugio que no reposteé y se perdieron. '
                              . 'Sigue sin confirmar cuántas salieron del evento de yoga.',
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
                'fuente'     => 'Confirmado. Incluye 2 publicaciones que entraron por una colaboración '
                              . 'aceptada en agosto de 2026.',
            ],
            [
                'metrica'    => 'Seguidores en Instagram',
                'confirmado' => '122',
                'estimado'   => null,
                'fuente'     => 'Confirmado.',
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
                'fuente'     => 'Septiembre de 2025 a febrero de 2026. Confirmado por las fechas de las '
                              . 'publicaciones.',
            ],
        ],
        'nota' => 'Los estimados son cálculos míos y todavía no tienen constancia de los refugios. Cuando '
                . 'revisé este expediente en agosto de 2026 quité una cifra de croqueta que llevaba meses '
                . 'circulando y no podía comprobar; la sustituí por los kilos que sí se ven en las fotos. '
                . 'Prefiero un número chico y verificable. Sigo dando seguimiento a las constancias.',
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
            'Entre febrero y agosto de 2026 el proyecto estuvo en pausa. Lo pausé para concentrarme en '
            . 'Estudia, una plataforma educativa gratuita que construyo solo. No podía sostener los dos '
            . 'al mismo tiempo y preferí decirlo en vez de dejarlo colgado sin explicación.',
            'En agosto de 2026 lo retomé. La cuenta sigue activa y las alianzas con los dos refugios y '
            . 'el estudio de yoga también.',
        ],
        'pendientes' => [
            'titulo' => 'Lo que falta',
            'items'  => [
                'Constancias por escrito de @patitas_porbimba y @propatitasgdl. Los mensajes ya están '
                . 'enviados; sigo sin respuesta.',
                'Constancia del evento del 16 de octubre, por solicitar a Tecmilenio.',
                'Confirmar con el refugio si las 2 adopciones salieron del evento de yoga o de redes.',
                'Definir la primera actividad concreta de esta segunda etapa.',
            ],
        ],
    ],

    'pie' => [
        'autor'         => 'Hugo Rivera',
        'autor_url'     => 'https://hugorivera.me',
        'instagram'     => '@huellitasalcorazon.gdl',
        'instagram_url' => 'https://www.instagram.com/huellitasalcorazon.gdl/',
        'lugar'         => 'Guadalajara, Jalisco, México',
        'firma'         => 'Con amor, por Hugo Rivera.',
    ],
];

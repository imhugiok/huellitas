<?php
/** @var array $bloque */
/** @var string $indice */

$mostrarAnexosPendientes = $bloque['mostrar_anexos_pendientes'] ?? true;

// El canal lateral repite las actividades en corto y hace de progreso de
// lectura: el JS marca cual va viendo el lector.
$canal = array_map(static fn (array $item): array => [
    'ancla' => 'actividad-' . $item['id'],
    'texto' => $item['corto'],
    'fecha' => $item['fecha'],
], $bloque['items']);
?>
<section class="seccion seccion--actividades" id="actividades" aria-labelledby="actividades-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'actividades',
            'canal'  => $canal,
        ]); ?>

        <div class="seccion__contenido">
            <div class="actividades">
                <?php foreach ($bloque['items'] as $i => $item): ?>
                    <?php componente('actividad', [
                        'item'                    => $item,
                        'numero'                  => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                        'mostrarAnexosPendientes' => $mostrarAnexosPendientes,
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

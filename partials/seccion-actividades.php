<?php
/** @var array $bloque */
/** @var string $indice */

$mostrarAnexosPendientes = $bloque['mostrar_anexos_pendientes'] ?? true;
?>
<section class="seccion seccion--actividades" id="actividades" aria-labelledby="actividades-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'indice' => $indice,
            'titulo' => $bloque['titulo'],
            'id'     => 'actividades',
        ]); ?>

        <div class="seccion__contenido">
            <p class="seccion__entradilla"><?= e($bloque['entradilla']) ?></p>

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

<?php
/** @var array $bloque */
/** @var string $indice */
?>
<section class="seccion seccion--numeros" id="numeros" aria-labelledby="numeros-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'numeros',
        ]); ?>

        <div class="seccion__contenido">
        <div class="tabla-envoltura">
            <table class="tabla-numeros">
                <caption class="visualmente-oculto">
                    Métricas del proyecto separadas en dos columnas: cifras confirmadas y verificables
                    por un tercero, y estimaciones propias.
                </caption>

                <thead>
                    <tr>
                        <?php foreach ($bloque['cabeceras'] as $clave => $cabecera): ?>
                            <th scope="col" class="col-<?= e($clave) ?>">
                                <?= e($cabecera['titulo']) ?>
                                <?php if (!empty($cabecera['nota'])): ?>
                                    <span class="col__nota"><?= e($cabecera['nota']) ?></span>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($bloque['filas'] as $fila): ?>
                        <tr>
                            <th scope="row" class="col-metrica">
                                <span class="metrica__nombre"><?= e($fila['metrica']) ?></span>
                                <?php if (!empty($fila['fuente'])): ?>
                                    <span class="metrica__fuente"><?= enlazar_cuentas($fila['fuente']) ?></span>
                                <?php endif; ?>
                            </th>

                            <td class="col-confirmado" data-col="<?= e($bloque['cabeceras']['confirmado']['titulo']) ?>">
                                <?php if ($fila['confirmado'] !== null): ?>
                                    <span class="<?= e(clase_valor($fila['confirmado'], 'confirmada')) ?>"><?= e($fila['confirmado']) ?></span>
                                <?php else: ?>
                                    <span class="cifra cifra--vacia" aria-hidden="true">—</span>
                                    <span class="visualmente-oculto">Sin cifra confirmada</span>
                                <?php endif; ?>
                            </td>

                            <td class="col-estimado" data-col="<?= e($bloque['cabeceras']['estimado']['titulo']) ?>">
                                <?php if ($fila['estimado'] !== null): ?>
                                    <span class="<?= e(clase_valor($fila['estimado'], 'estimada')) ?>"><?= e($fila['estimado']) ?></span>
                                <?php else: ?>
                                    <span class="cifra cifra--vacia" aria-hidden="true">—</span>
                                    <span class="visualmente-oculto">Sin estimación</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        </div>

    </div>
</section>

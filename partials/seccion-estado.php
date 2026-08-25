<?php
/** @var array $bloque */
/** @var string $indice */
?>
<section class="seccion seccion--estado" id="estado" aria-labelledby="estado-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'estado',
        ]); ?>

        <div class="seccion__contenido">
        <div class="estado-actual">
            <div class="prosa">
                <?php foreach ($bloque['parrafos'] as $parrafo): ?>
                    <p><?= enlazar_cuentas($parrafo) ?></p>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($bloque['pendientes']['items'])): ?>
                <aside class="pendientes" aria-labelledby="pendientes-titulo">
                    <h3 class="pendientes__titulo" id="pendientes-titulo"><?= e($bloque['pendientes']['titulo']) ?></h3>
                    <ul class="pendientes__lista">
                        <?php foreach ($bloque['pendientes']['items'] as $pendiente): ?>
                            <li><?= enlazar_cuentas($pendiente) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>
        </div>

        </div>

    </div>
</section>

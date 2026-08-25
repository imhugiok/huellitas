<?php
/** @var array $bloque */
/** @var string $indice */
?>
<section class="seccion seccion--que-es" id="que-es" aria-labelledby="que-es-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'que-es',
        ]); ?>

        <div class="seccion__contenido">
            <div class="prosa">
                <?php foreach ($bloque['parrafos'] as $i => $parrafo): ?>
                    <p<?= $i === 0 ? ' class="prosa__destacado"' : '' ?>><?= enlazar_cuentas($parrafo) ?></p>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

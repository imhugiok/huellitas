<?php
/** @var array $pie */
?>
<footer class="pie">
    <div class="contenedor">

        <?php $actualizado = ultima_actualizacion(); ?>
        <p class="pie__nota">
            Última actualización del contenido:
            <time datetime="<?= e(date('Y-m-d', $actualizado)) ?>"><?= e(fecha_es($actualizado)) ?></time>.
        </p>

        <p class="pie__firma"><?= e($pie['firma']) ?></p>

    </div>
</footer>

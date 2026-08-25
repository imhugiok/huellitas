<?php
/** @var array $pie */
/** @var array $sitio */
?>
<footer class="pie">
    <div class="contenedor">

        <div class="pie__contenido">
            <p class="pie__marca"><?= e($sitio['nombre']) ?></p>

            <ul class="pie__datos">
                <li>
                    <a href="<?= e($pie['autor_url']) ?>" target="_blank" rel="noopener noreferrer">
                        <?= e($pie['autor']) ?> — hugorivera.me
                    </a>
                </li>
                <li>
                    <a href="<?= e($pie['instagram_url']) ?>" target="_blank" rel="noopener noreferrer">
                        Instagram: <?= e($pie['instagram']) ?>
                    </a>
                </li>
                <li><?= e($pie['lugar']) ?></li>
            </ul>
        </div>

        <?php /* Linea de cierre, centrada abajo del todo y separada por una regla. */ ?>
        <div class="pie__legal">
            <div class="pie__regla" aria-hidden="true"></div>
            <?php $actualizado = ultima_actualizacion(); ?>
            <p>
                Última actualización del contenido:
                <time datetime="<?= e(date('Y-m-d', $actualizado)) ?>"><?= e(fecha_es($actualizado)) ?></time>.
                Con amor, por <a href="<?= e($pie['autor_url']) ?>"
                                 target="_blank" rel="noopener noreferrer"><?= e($pie['autor']) ?></a>.
            </p>
        </div>

    </div>
</footer>

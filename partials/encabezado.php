<?php
/** @var array $hero */
/** @var array $secciones */
?>
<header class="encabezado">
    <div class="contenedor">

        <div class="encabezado__marca">
            <div class="marca">
                <?= svg_en_linea('assets/img/logo.svg', 'marca__logo', '') ?>
                <h1 class="titulo-principal"><?= e($hero['titulo']) ?></h1>
            </div>

            <p class="subtitulo"><?= e($hero['subtitulo']) ?></p>
        </div>

        <nav class="indice" aria-label="Índice del expediente">
            <ol class="indice__lista">
                <?php foreach ($secciones as $i => $seccion): ?>
                    <?php $fuera = isset($seccion['url']); ?>
                    <li class="indice__item">
                        <a class="indice__enlace<?= $fuera ? ' indice__enlace--pagina' : '' ?>"
                           href="<?= e($fuera ? $seccion['url'] : '#' . $seccion['id']) ?>">
                            <span class="indice__numero"><?= e(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
                            <span class="indice__titulo">
                                <?= e($seccion['titulo']) ?><?php if ($fuera): ?><span class="indice__flecha" aria-hidden="true">→</span><?php endif; ?>
                            </span>
                            <?php if ($fuera): ?><span class="visualmente-oculto">(página aparte)</span><?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>

    </div>
</header>

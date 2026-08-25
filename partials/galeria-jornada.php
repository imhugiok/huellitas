<?php
/**
 * Una jornada de la galeria.
 *
 * En la portada ($limite puesto) sale como bloque normal dentro de la reja, y
 * la ultima casilla es el "+N" que lleva a /galeria.
 *
 * En /galeria ($ancha) el titulo va arriba, una linea lo separa de la fecha y
 * la descripcion, y las fotos ocupan de borde a borde.
 */
/** @var array $grupo */
/** @var string $alt */
/** @var int|null $limite */
/** @var bool|null $ancha */

$ancha   = $ancha ?? false;
$fotos   = $grupo['fotos'];
$total   = count($fotos);
$recorta = $limite !== null && $total > $limite;
$visibles  = $recorta ? array_slice($fotos, 0, $limite - 1) : $fotos;
$restantes = $total - count($visibles);
?>
<section class="jornada<?= $ancha ? ' jornada--ancha' : '' ?>" id="jornada-<?= e($grupo['id']) ?>"
         aria-labelledby="jornada-<?= e($grupo['id']) ?>-titulo">

    <?php if ($ancha): ?>

        <div class="contenedor">
        <div class="jornada__encabezado">
            <h2 class="jornada__titulo" id="jornada-<?= e($grupo['id']) ?>-titulo">
                <?= e($grupo['titulo']) ?>
            </h2>

            <div class="jornada__pie">
                <?php if ($grupo['fecha_iso'] !== null): ?>
                    <time class="fecha" datetime="<?= e($grupo['fecha_iso']) ?>"><?= e($grupo['fecha']) ?></time>
                <?php else: ?>
                    <span class="fecha"><?= e($grupo['fecha']) ?></span>
                <?php endif; ?>

                <p class="jornada__texto"><?= e($grupo['texto']) ?></p>

                <p class="jornada__cuenta"><?= e((string) $total) ?> fotos</p>
            </div>
        </div>
        </div>

    <?php else: ?>

        <?php if ($grupo['fecha_iso'] !== null): ?>
            <time class="fecha" datetime="<?= e($grupo['fecha_iso']) ?>"><?= e($grupo['fecha']) ?></time>
        <?php else: ?>
            <span class="fecha"><?= e($grupo['fecha']) ?></span>
        <?php endif; ?>

        <h3 class="jornada__titulo" id="jornada-<?= e($grupo['id']) ?>-titulo"><?= e($grupo['titulo']) ?></h3>
        <p class="jornada__texto"><?= e($grupo['texto']) ?></p>

    <?php endif; ?>

    <?php if ($ancha): ?><div class="contenedor"><?php endif; ?>
    <ul class="cuadricula<?= $ancha ? ' cuadricula--ancha' : '' ?>">
        <?php foreach ($visibles as $i => $foto): ?>
            <?php $descripcion = sprintf($alt, $i + 1, mb_strtolower($grupo['titulo'])); ?>
            <li>
                <a class="cuadricula__foto" href="<?= e($foto['grande']) ?>"
                   data-visor="<?= e($descripcion) ?>">
                    <img
                        src="<?= e($foto['src']) ?>"
                        alt="<?= e($descripcion) ?>"
                        <?= $foto['ancho'] ? 'width="' . (int) $foto['ancho'] . '"' : '' ?>
                        <?= $foto['alto'] ? 'height="' . (int) $foto['alto'] . '"' : '' ?>
                        loading="lazy" decoding="async">
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($recorta): ?>
            <li>
                <a class="cuadricula__mas" href="/galeria#jornada-<?= e($grupo['id']) ?>">
                    <span class="cuadricula__cifra">+<?= e((string) $restantes) ?></span>
                    <span class="cuadricula__pie">fotos</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php if ($ancha): ?></div><?php endif; ?>
</section>

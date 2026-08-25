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

// $limite es el numero de CASILLAS, no de fotos: la ultima lleva el contador
// encima, asi que a la vista quedan $limite - 1 fotos.
$visibles  = $recorta ? array_slice($fotos, 0, $limite) : $fotos;
$restantes = $recorta ? $total - ($limite - 1) : 0;

// En /galeria una jornada de 275 fotos es una pared. Se enseñan las primeras
// 30 y la casilla 30 lleva el contador; al pulsarla aparecen las demas.
// Variable y no constante: este partial se incluye una vez por jornada.
$asomoMaximo = 30;

// Sin JS salen todas: el recorte es una comodidad, no una condicion para leer
// la pagina. El data-asomo le dice al JS donde poner el contador.
$asomo = ($ancha && $total > $asomoMaximo + 6) ? $asomoMaximo : null;
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
    <ul class="cuadricula<?= $ancha ? ' cuadricula--ancha' : '' ?>"
        <?= $asomo !== null ? 'data-asomo="' . (int) $asomo . '"' : '' ?>>
        <?php foreach ($visibles as $i => $foto): ?>
            <?php
            $descripcion = sprintf($alt, $i + 1, mb_strtolower($grupo['titulo']));
            $esUltima    = $recorta && $i === count($visibles) - 1;
            ?>
            <li>
                <a class="cuadricula__foto<?= $esUltima ? ' cuadricula__foto--mas' : '' ?>"
                   href="<?= $esUltima ? '/galeria#jornada-' . e($grupo['id']) : e($foto['grande']) ?>"
                   <?= $esUltima ? '' : 'data-visor="' . e($descripcion) . '"' ?>>
                    <?php if ($esUltima): ?>
                        <span class="cuadricula__contador">
                            <span class="cuadricula__cifra">+<?= e((string) $restantes) ?></span>
                            <span class="cuadricula__pie">fotos</span>
                        </span>
                    <?php endif; ?>
                    <img
                        src="<?= e($foto['src']) ?>"
                        alt="<?= e($descripcion) ?>"
                        <?= $foto['ancho'] ? 'width="' . (int) $foto['ancho'] . '"' : '' ?>
                        <?= $foto['alto'] ? 'height="' . (int) $foto['alto'] . '"' : '' ?>
                        loading="lazy" decoding="async">
                </a>
            </li>
        <?php endforeach; ?>

    </ul>

    <?php if ($ancha): ?></div><?php endif; ?>
</section>

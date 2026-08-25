<?php
/**
 * Una jornada de la galeria. Con $limite puesto, la ultima casilla deja de
 * ser foto y pasa a ser el "+N" que lleva a la galeria completa.
 */
/** @var array $grupo */
/** @var string $alt */
/** @var int|null $limite */

$fotos   = $grupo['fotos'];
$total   = count($fotos);
$recorta = $limite !== null && $total > $limite;
$visibles = $recorta ? array_slice($fotos, 0, $limite - 1) : $fotos;
$restantes = $total - count($visibles);
?>
<section class="jornada" id="jornada-<?= e($grupo['id']) ?>"
         aria-labelledby="jornada-<?= e($grupo['id']) ?>-titulo">

    <?php if ($grupo['fecha_iso'] !== null): ?>
        <time class="fecha" datetime="<?= e($grupo['fecha_iso']) ?>"><?= e($grupo['fecha']) ?></time>
    <?php else: ?>
        <span class="fecha"><?= e($grupo['fecha']) ?></span>
    <?php endif; ?>

    <h3 class="jornada__titulo" id="jornada-<?= e($grupo['id']) ?>-titulo"><?= e($grupo['titulo']) ?></h3>
    <p class="jornada__texto"><?= e($grupo['texto']) ?></p>

    <ul class="cuadricula">
        <?php foreach ($visibles as $i => $foto): ?>
            <li>
                <a class="cuadricula__foto" href="<?= e($foto['src']) ?>"
                   data-visor="<?= e(sprintf($alt, $i + 1, mb_strtolower($grupo['titulo']))) ?>">
                    <img
                        src="<?= e($foto['src']) ?>"
                        alt="<?= e(sprintf($alt, $i + 1, mb_strtolower($grupo['titulo']))) ?>"
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
</section>

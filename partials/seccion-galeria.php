<?php
/**
 * Galeria por jornada. Las fotos no se listan aqui ni en contenido.php: se
 * leen de /assets/img/galeria/<grupo>. Dejas el archivo y aparece.
 */
/** @var array $bloque */

$grupos = [];

foreach ($bloque['grupos'] as $grupo) {
    $fotos = fotos_de_galeria($grupo['id']);

    if ($fotos !== []) {
        $grupos[] = $grupo + ['fotos' => $fotos];
    }
}

if ($grupos === []) {
    return;
}
?>
<section class="seccion seccion--galeria" id="galeria" aria-labelledby="galeria-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'galeria',
            'canal'  => array_map(static fn (array $g): array => [
                'ancla' => 'jornada-' . $g['id'],
                'texto' => $g['corto'],
                'fecha' => $g['fecha'],
            ], $grupos),
        ]); ?>

        <div class="seccion__contenido">
            <?php foreach ($grupos as $grupo): ?>
                <section class="jornada" id="jornada-<?= e($grupo['id']) ?>"
                         aria-labelledby="jornada-<?= e($grupo['id']) ?>-titulo">

                    <?php if ($grupo['fecha_iso'] !== null): ?>
                        <time class="fecha" datetime="<?= e($grupo['fecha_iso']) ?>"><?= e($grupo['fecha']) ?></time>
                    <?php else: ?>
                        <span class="fecha"><?= e($grupo['fecha']) ?></span>
                    <?php endif; ?>

                    <h3 class="jornada__titulo" id="jornada-<?= e($grupo['id']) ?>-titulo">
                        <?= e($grupo['titulo']) ?>
                    </h3>

                    <p class="jornada__texto"><?= e($grupo['texto']) ?></p>

                    <ul class="cuadricula">
                        <?php foreach ($grupo['fotos'] as $i => $foto): ?>
                            <li>
                                <a class="cuadricula__foto" href="<?= e($foto['src']) ?>"
                                   target="_blank" rel="noopener noreferrer">
                                    <img
                                        src="<?= e($foto['src']) ?>"
                                        alt="<?= e(sprintf($bloque['alt'], $i + 1, mb_strtolower($grupo['titulo']))) ?>"
                                        <?= $foto['ancho'] ? 'width="' . (int) $foto['ancho'] . '"' : '' ?>
                                        <?= $foto['alto'] ? 'height="' . (int) $foto['alto'] . '"' : '' ?>
                                        loading="lazy" decoding="async">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endforeach; ?>

            <p class="galeria__nota"><?= e($bloque['nota']) ?></p>
        </div>

    </div>
</section>

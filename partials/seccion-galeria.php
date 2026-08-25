<?php
/**
 * Galeria. Las fotos no se listan en contenido.php: se leen de
 * /assets/img/galeria/<grupo>. Dejas el archivo y aparece.
 *
 * Con $limite se dibuja el bloque de la portada, dentro de la reja de
 * secciones. Sin el, la version ancha de /galeria.
 */
/** @var array $bloque */
/** @var int|null $limite */

$limite = $limite ?? null;
$ancha  = $limite === null;

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

if ($ancha) {
    foreach ($grupos as $grupo) {
        componente('galeria-jornada', [
            'grupo' => $grupo,
            'alt'   => $bloque['alt'],
            'limite' => null,
            'ancha' => true,
        ]);
    }
    ?>
    <div class="contenedor">
        <p class="galeria__nota"><?= e($bloque['nota']) ?></p>
    </div>
    <?php
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
                <?php componente('galeria-jornada', [
                    'grupo'  => $grupo,
                    'alt'    => $bloque['alt'],
                    'limite' => $limite,
                ]); ?>
            <?php endforeach; ?>

            <p class="galeria__salida">
                <a class="enlace-texto" href="/galeria"><?= e($bloque['enlace_completa']) ?></a>
            </p>

            <p class="galeria__nota"><?= e($bloque['nota']) ?></p>
        </div>

    </div>
</section>

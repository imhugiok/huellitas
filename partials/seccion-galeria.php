<?php
/**
 * Galeria. Las fotos no se listan en contenido.php: se leen de
 * /assets/img/galeria/<grupo>. Dejas el archivo y aparece.
 */
/** @var array $bloque */
/** @var int|null $limite   Fotos por jornada en la portada; null = todas. */
$limite = $limite ?? null;

// En /galeria el h1 de la pagina ya dice "Galeria": repetirlo en la columna
// izquierda sobra. El canal de jornadas si se queda.
$tituloOculto = $limite === null;

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
            'titulo'       => $bloque['titulo'],
            'id'           => 'galeria',
            'tituloOculto' => $tituloOculto,
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

            <?php if ($limite !== null): ?>
                <p class="galeria__salida">
                    <a class="enlace-texto" href="/galeria"><?= e($bloque['enlace_completa']) ?></a>
                </p>
            <?php endif; ?>

            <p class="galeria__nota"><?= e($bloque['nota']) ?></p>
        </div>

    </div>
</section>

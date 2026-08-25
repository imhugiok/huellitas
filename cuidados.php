<?php
/**
 * Cuidados: articulos y preguntas frecuentes. Pagina aparte porque no es
 * expediente. No prueba lo que hizo el proyecto: divulga lo que aprendio
 * haciendolo.
 */

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$c = require __DIR__ . '/data/contenido.php';

$nonce = base64_encode(random_bytes(16));

header("Content-Security-Policy: "
    . "default-src 'self'; "
    . "base-uri 'self'; "
    . "object-src 'none'; "
    . "frame-ancestors 'none'; "
    . "form-action 'none'; "
    . "script-src 'self' 'nonce-{$nonce}'; "
    . "style-src 'self' https://fonts.googleapis.com; "
    . "font-src 'self' https://fonts.gstatic.com; "
    . "img-src 'self' data:; "
    . "connect-src 'self'; "
    . 'upgrade-insecure-requests');

// El head se alimenta de 'sitio': para esta pagina se le cambian titulo,
// descripcion y canonica, y lo demas queda igual.
$sitio = $c['sitio'] + [];
$sitio['titulo']      = $c['cuidados']['titulo'] . ' — ' . $c['sitio']['nombre'];
$sitio['descripcion'] = $c['cuidados']['descripcion'];
$sitio['url']         = rtrim($c['sitio']['url'], '/') . '/cuidados';
$sitio['raiz']        = $c['sitio']['url'];
$sitio['og_imagen']   = 'assets/img/og-cuidados.png';
$sitio['og_alt']      = 'Perros del refugio en el patio, entre comederos y jaulas.';

$autor = ['@type' => 'Person', 'name' => $c['pie']['autor'], 'url' => $c['pie']['autor_url']];

$grafo = [];

// Un Article por texto. Es lo que permite que un buscador o un modelo cite el
// articulo concreto y no la pagina entera.
foreach ($c['cuidados']['articulos']['items'] as $a) {
    $grafo[] = [
        '@type'            => 'Article',
        'headline'         => $a['titulo'],
        'description'      => $a['lede'],
        'articleBody'      => implode("

", $a['parrafos']),
        'inLanguage'       => 'es-MX',
        'url'              => $sitio['url'] . '#articulo-' . $a['id'],
        'author'           => $autor,
        'publisher'        => ['@type' => 'Organization', 'name' => $c['sitio']['nombre']],
        'isPartOf'         => ['@type' => 'WebPage', 'url' => $sitio['url']],
    ];
}

// FAQPage: Google restringio sus resultados enriquecidos a sitios de gobierno y
// salud desde agosto de 2023, asi que esto no va a pintar acordeones en la
// SERP. Se pone porque los modelos de lenguaje si lo leen para citar respuestas.
$grafo[] = [
    '@type'      => 'FAQPage',
    'inLanguage' => 'es-MX',
    'url'        => $sitio['url'] . '#preguntas',
    'mainEntity' => array_map(static fn (array $q): array => [
        '@type'          => 'Question',
        'name'           => $q['p'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['r']],
    ], $c['cuidados']['preguntas']['items']),
];

// La encuesta, como conjunto de datos con su procedencia.
$grafo[] = [
    '@type'            => 'Dataset',
    'name'             => 'Encuesta sobre perros en situación de calle en Guadalajara (2025)',
    'description'      => $c['cuidados']['encuesta']['contexto'],
    'url'              => $sitio['url'] . '#encuesta',
    'inLanguage'       => 'es-MX',
    'creator'          => $autor,
    'temporalCoverage' => '2025-08-28/2025-09-15',
    'spatialCoverage'  => ['@type' => 'Place', 'name' => 'Guadalajara, Jalisco, México'],
    'measurementTechnique' => 'Cuestionario en línea de 22 preguntas',
    'variableMeasured' => array_map(static fn (array $h): array => [
        '@type' => 'PropertyValue',
        'name'  => $h['dice'],
        'value' => $h['cifra'],
    ], $c['cuidados']['encuesta']['hallazgos']),
    'distribution'     => [
        '@type'       => 'DataDownload',
        'contentUrl'  => $c['cuidados']['encuesta']['enlace']['url'],
        'description' => 'Formulario original con las 22 preguntas',
    ],
];

$grafo[] = [
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => $c['sitio']['nombre'], 'item' => $c['sitio']['url']],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $c['cuidados']['titulo'], 'item' => $sitio['url']],
    ],
];
?>
<!doctype html>
<html lang="<?= e($c['sitio']['idioma']) ?>">
<?php componente('head', ['sitio' => $sitio, 'pie' => $c['pie'], 'nonce' => $nonce, 'grafo' => $grafo]); ?>
<body>

<a class="saltar-al-contenido" href="#contenido">Saltar al contenido</a>

<header class="encabezado encabezado--interior">
    <div class="contenedor">
        <p class="volver">
            <a href="/">← <?= e($c['sitio']['nombre']) ?></a>
        </p>
        <h1 class="titulo-interior"><?= e($c['cuidados']['titulo']) ?></h1>
        <p class="subtitulo"><?= e($c['cuidados']['entradilla']) ?></p>
    </div>
</header>

<main id="contenido">
    <?php componente('seccion-cuidados', ['bloque' => $c['cuidados']]); ?>
</main>

<?php componente('visor'); ?>
<?php componente('pie', ['pie' => $c['pie'], 'sitio' => $c['sitio']]); ?>

<script src="<?= e(asset('assets/js/site.js')) ?>" nonce="<?= e($nonce) ?>" defer></script>
</body>
</html>

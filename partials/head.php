<?php
/** @var array $sitio */
/** @var array $pie */
/** @var string $nonce */
/** @var array|null $grafo  Nodos JSON-LD propios de la pagina. */

// La imagen social se resuelve contra la raiz del sitio, no contra la URL de
// la pagina: si no, /galeria pediria /galeria/assets/img/og-galeria.png.
$ogAbsoluta = url_absoluta($sitio['og_imagen'], $sitio['raiz'] ?? $sitio['url']);

$organizacion = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Organization',
    'name'        => $sitio['nombre'],
    'url'         => $sitio['url'],
    'description' => $sitio['descripcion'],
    'foundingDate' => '2025-09',
    'logo'        => url_absoluta('assets/img/icono-512.png', $sitio['url']),
    'areaServed'  => ['@type' => 'City', 'name' => 'Guadalajara, Jalisco, México'],
    'sameAs'      => [$pie['instagram_url']],
    'founder'     => ['@type' => 'Person', 'name' => $pie['autor'], 'url' => $pie['autor_url']],
];

// Un solo @graph con la organizacion, el sitio y lo que aporte cada pagina.
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph'   => array_merge([
        $organizacion,
        [
            '@type'         => 'WebSite',
            'name'          => $sitio['nombre'],
            'url'           => $sitio['raiz'] ?? $sitio['url'],
            'inLanguage'    => 'es-MX',
            'publisher'     => ['@type' => 'Organization', 'name' => $sitio['nombre']],
        ],
    ], $grafo ?? []),
];
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

<title><?= e($sitio['titulo']) ?></title>
<meta name="description" content="<?= e($sitio['descripcion']) ?>">
<link rel="canonical" href="<?= e($sitio['url']) ?>">
<meta name="author" content="<?= e($pie['autor']) ?>">
<meta name="theme-color" content="#faf8f5">
<meta name="color-scheme" content="light">

<meta property="og:type" content="website">
<meta property="og:locale" content="es_MX">
<meta property="og:site_name" content="<?= e($sitio['nombre']) ?>">
<meta property="og:title" content="<?= e($sitio['titulo']) ?>">
<meta property="og:description" content="<?= e($sitio['descripcion']) ?>">
<meta property="og:url" content="<?= e($sitio['url']) ?>">
<meta property="og:image" content="<?= e($ogAbsoluta) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= e($sitio['og_alt'] ?? 'Huellitas al Corazón — proyecto de bienestar animal en Guadalajara.') ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($sitio['titulo']) ?>">
<meta name="twitter:description" content="<?= e($sitio['descripcion']) ?>">
<meta name="twitter:image" content="<?= e($ogAbsoluta) ?>">
<meta name="twitter:image:alt" content="<?= e($sitio['og_alt'] ?? 'Huellitas al Corazón — proyecto de bienestar animal en Guadalajara.') ?>">

<link rel="icon" href="<?= e(asset('assets/img/logo.svg')) ?>" type="image/svg+xml">
<link rel="icon" href="<?= e(asset('assets/img/icono-512.png')) ?>" sizes="512x512">
<link rel="apple-touch-icon" href="<?= e(asset('assets/img/icono-180.png')) ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400..700&amp;display=swap">

<link rel="stylesheet" href="<?= e(asset('assets/css/site.css')) ?>">

<script type="application/ld+json" nonce="<?= e($nonce) ?>"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>

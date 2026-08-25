<?php
/**
 * Galeria completa. Misma cabecera, mismo pie y el mismo bloque de galeria
 * que la portada, pero sin recorte: aqui salen todas las fotos.
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
$sitio['titulo']      = $c['galeria']['titulo'] . ' — ' . $c['sitio']['nombre'];
$sitio['descripcion'] = $c['galeria']['descripcion'];
$sitio['url']         = rtrim($c['sitio']['url'], '/') . '/galeria';
?>
<!doctype html>
<html lang="<?= e($c['sitio']['idioma']) ?>">
<?php componente('head', ['sitio' => $sitio, 'pie' => $c['pie'], 'nonce' => $nonce]); ?>
<body>

<a class="saltar-al-contenido" href="#contenido">Saltar al contenido</a>

<header class="encabezado encabezado--interior">
    <div class="contenedor">
        <p class="volver">
            <a href="/">← <?= e($c['sitio']['nombre']) ?></a>
        </p>
        <h1 class="titulo-interior"><?= e($c['galeria']['titulo']) ?></h1>
        <p class="subtitulo"><?= e($c['galeria']['entradilla']) ?></p>
    </div>
</header>

<main id="contenido">
    <?php componente('seccion-galeria', ['bloque' => $c['galeria'], 'limite' => null]); ?>
</main>

<?php componente('visor'); ?>
<?php componente('pie', ['pie' => $c['pie'], 'sitio' => $c['sitio']]); ?>

<script src="<?= e(asset('assets/js/site.js')) ?>" nonce="<?= e($nonce) ?>" defer></script>
</body>
</html>

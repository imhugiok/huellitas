<?php
/**
 * Huellitas al Corazon - pagina de evidencia.
 * Una sola vista compuesta por componentes de /partials.
 * El contenido vive en /data/contenido.php, no aqui.
 */

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$c = require __DIR__ . '/data/contenido.php';

/**
 * CSP con nonce por peticion. Va aqui y no en .htaccess porque el nonce
 * cambia en cada carga y tiene que coincidir con las etiquetas <script>.
 */
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

$secciones = [
    ['id' => 'que-es',       'titulo' => $c['que_es']['titulo']],
    ['id' => 'actividades',  'titulo' => $c['actividades']['titulo']],
    ['id' => 'galeria',      'titulo' => $c['galeria']['titulo'], 'url' => '/galeria'],
    ['id' => 'numeros',      'titulo' => $c['numeros']['titulo']],
    ['id' => 'aliados',      'titulo' => $c['aliados']['titulo']],
    ['id' => 'estado',       'titulo' => $c['estado']['titulo']],
];
?>
<!doctype html>
<html lang="<?= e($c['sitio']['idioma']) ?>">
<?php componente('head', ['sitio' => $c['sitio'], 'pie' => $c['pie'], 'nonce' => $nonce]); ?>
<body>

<a class="saltar-al-contenido" href="#contenido">Saltar al contenido</a>

<?php componente('encabezado', ['hero' => $c['hero'], 'secciones' => $secciones]); ?>

<main id="contenido">

    <?php componente('seccion-que-es', ['bloque' => $c['que_es']]); ?>

    <?php componente('seccion-actividades', ['bloque' => $c['actividades']]); ?>

    <?php componente('seccion-galeria', ['bloque' => $c['galeria'], 'limite' => 8]); ?>

    <?php componente('seccion-numeros', ['bloque' => $c['numeros']]); ?>

    <?php componente('seccion-aliados', ['bloque' => $c['aliados']]); ?>

    <?php componente('seccion-estado', ['bloque' => $c['estado']]); ?>

</main>

<?php componente('visor'); ?>

<?php componente('pie', ['pie' => $c['pie'], 'sitio' => $c['sitio']]); ?>

<script src="<?= e(asset('assets/js/site.js')) ?>" nonce="<?= e($nonce) ?>" defer></script>
</body>
</html>

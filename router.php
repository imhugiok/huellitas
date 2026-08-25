<?php
/**
 * Enrutador solo para el servidor de desarrollo de PHP, que no lee .htaccess.
 * Sin esto, /galeria da 404 en local mientras que en Hostinger funciona, y
 * los enlaces de la pagina parecen rotos cuando no lo estan.
 *
 *   php -S 127.0.0.1:8765 router.php
 *
 * En produccion no se usa nunca: de eso se encarga el .htaccess.
 */

declare(strict_types=1);

if (PHP_SAPI !== 'cli-server') {
    http_response_code(404);
    return true;
}

$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Las carpetas que el .htaccess bloquea en produccion, bloqueadas tambien aqui.
if (preg_match('~^/(data|lib|partials)/~', $ruta)) {
    http_response_code(403);
    return true;
}

$rutas = [
    '~^/galeria/?$~'  => 'galeria.php',
    '~^/cuidados/?$~' => 'cuidados.php',
    '~^/sitemap\.xml$~' => 'sitemap.php',
];

foreach ($rutas as $patron => $archivo) {
    if (preg_match($patron, $ruta)) {
        require __DIR__ . '/' . $archivo;
        return true;
    }
}

// Cualquier otra cosa que exista en disco la sirve el servidor tal cual.
return false;

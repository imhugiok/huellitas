<?php
/**
 * Sitemap dinamico. La fecha sale de /data/contenido.php, asi que nunca miente
 * sobre cuando se actualizo la pagina. Se sirve como /sitemap.xml (ver .htaccess).
 */

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$c = require __DIR__ . '/data/contenido.php';

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= e($c['sitio']['url']) ?></loc>
        <lastmod><?= e(date('Y-m-d', ultima_actualizacion())) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
</urlset>

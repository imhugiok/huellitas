<?php
/**
 * Capa minima de render. Hace lo que haria un framework de componentes, en
 * ~80 lineas y sin dependencias: escapado por defecto, componentes con props,
 * cache-busting de assets y resolucion de imagenes con degradado elegante.
 */

declare(strict_types=1);

const RAIZ = __DIR__ . '/..';

/**
 * El proyecto es de Guadalajara y la pagina presume de estar bien fechada, asi
 * que la zona no se deja al azar del servidor. Hostinger sirve en UTC y XAMPP
 * a veces en Europa: sin esto, el pie anunciaba el dia siguiente desde las
 * seis de la tarde. Mexico no aplica horario de verano desde 2022.
 */
date_default_timezone_set('America/Mexico_City');

/** Escapa para HTML. Todo texto pasa por aqui antes de imprimirse. */
function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Renderiza un componente de /partials con props aisladas.
 * Equivale a <Componente prop={valor} />: el partial solo ve lo que le pasas.
 */
function componente(string $nombre, array $props = []): void
{
    $ruta = RAIZ . '/partials/' . $nombre . '.php';

    if (!is_file($ruta)) {
        throw new RuntimeException("Componente no encontrado: {$nombre}");
    }

    (static function (string $__ruta, array $props): void {
        extract($props, EXTR_SKIP);
        require $__ruta;
    })($ruta, $props);
}

/**
 * URL de un asset con hash de modificacion. Permite cachear un ano en
 * .htaccess sin quedarse con CSS viejo despues de un deploy.
 */
function asset(string $ruta): string
{
    $absoluta = RAIZ . '/' . ltrim($ruta, '/');
    $version  = is_file($absoluta) ? (string) filemtime($absoluta) : '0';

    return '/' . ltrim($ruta, '/') . '?v=' . substr(md5($version), 0, 8);
}

/**
 * Busca la foto de un bloque en /assets/img probando formatos por preferencia.
 * Devuelve null si no existe ninguna: la plantilla dibuja entonces un marcador
 * honesto en vez de una imagen rota o una foto de stock.
 */
function foto(string $slug): ?array
{
    foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
        $relativa = "assets/img/{$slug}.{$ext}";

        if (is_file(RAIZ . '/' . $relativa)) {
            $medidas = @getimagesize(RAIZ . '/' . $relativa);

            return [
                'src'    => asset($relativa),
                'ancho'  => $medidas[0] ?? null,
                'alto'   => $medidas[1] ?? null,
            ];
        }
    }

    return null;
}

/**
 * Inserta un SVG en el HTML en vez de enlazarlo como <img>. Sirve para el logo:
 * el archivo usa fill="currentColor", asi que insertado en linea se colorea
 * desde CSS y no cuesta una peticion extra.
 */
function svg_en_linea(string $ruta, string $clase = '', string $titulo = ''): string
{
    $absoluta = RAIZ . '/' . ltrim($ruta, '/');

    if (!is_file($absoluta)) {
        return '';
    }

    $svg = (string) file_get_contents($absoluta);

    // Fuera la cabecera XML y el DOCTYPE: dentro de HTML sobran.
    $svg = preg_replace('~<\?xml.*?\?>|<!DOCTYPE[^>]*>~is', '', $svg) ?? $svg;
    $svg = trim($svg);

    $atributos = 'aria-hidden="true" focusable="false"';

    if ($titulo !== '') {
        $atributos = 'role="img" aria-label="' . e($titulo) . '"';
    }

    if ($clase !== '') {
        $atributos .= ' class="' . e($clase) . '"';
    }

    return preg_replace('~<svg~', '<svg ' . $atributos, $svg, 1) ?? $svg;
}

/** Convierte @cuenta suelta dentro de un texto en enlace a Instagram. */
function enlazar_cuentas(string $texto): string
{
    $html = e($texto);

    // [texto](https://...) para enlazar fuera de Instagram. Solo https, para
    // que del contenido no pueda salir un javascript: por descuido.
    $html = preg_replace_callback(
        '~\[([^\]]+)\]\((https://[^\s)]+)\)~',
        static fn (array $m): string =>
            '<a class="enlace-texto" href="' . $m[2] . '"'
            . ' target="_blank" rel="noopener noreferrer">' . $m[1] . '</a>',
        $html
    );

    return preg_replace_callback(
        '~@([A-Za-z0-9._]+)~',
        static fn (array $m): string =>
            '<a class="cuenta" href="https://www.instagram.com/' . rawurlencode($m[1]) . '/"'
            . ' target="_blank" rel="noopener noreferrer">@' . e($m[1]) . '</a>',
        $html
    );
}

/**
 * Lista las fotos de un grupo de la galeria, en orden de nombre. Igual que
 * con los anexos de las actividades: se dejan los archivos en la carpeta y
 * aparecen solos, sin tocar codigo. Si la carpeta no existe, no pasa nada.
 */
function fotos_de_galeria(string $grupo): array
{
    $dir = RAIZ . '/assets/img/galeria/' . $grupo;

    if (!is_dir($dir)) {
        return [];
    }

    $archivos = glob($dir . '/*.{webp,jpg,jpeg,png}', GLOB_BRACE) ?: [];
    sort($archivos);

    $fotos = [];

    foreach ($archivos as $ruta) {
        $nombre  = basename($ruta);
        $medidas = @getimagesize($ruta);
        $base    = 'assets/img/galeria/' . $grupo . '/';

        // La grande solo existe para el visor. Si falta, se usa la chica.
        $grande = is_file($dir . '/grande/' . $nombre)
            ? asset($base . 'grande/' . $nombre)
            : asset($base . $nombre);

        $fotos[] = [
            'src'    => asset($base . $nombre),
            'grande' => $grande,
            'ancho'  => $medidas[0] ?? null,
            'alto'   => $medidas[1] ?? null,
        ];
    }

    return $fotos;
}

/** URL absoluta a partir de una ruta relativa, para OG y JSON-LD. */
function url_absoluta(string $ruta, string $base): string
{
    return rtrim($base, '/') . '/' . ltrim($ruta, '/');
}

/**
 * Clase para una celda de la tabla: las cifras van grandes, los valores que
 * son texto ("Entregas recurrentes") van chicos o aplastan la fila.
 */
function clase_valor(string $valor, string $tipo): string
{
    $esCifra = preg_match('/^[~+]?[0-9]/', $valor) === 1;

    return 'cifra cifra--' . $tipo . ($esCifra ? '' : ' cifra--texto');
}

/** Fecha larga en espanol sin depender de la extension intl. */
function fecha_es(int $marca): string
{
    $meses = [
        1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre',
    ];

    return sprintf(
        '%d de %s de %d',
        (int) date('j', $marca),
        $meses[(int) date('n', $marca)],
        (int) date('Y', $marca)
    );
}

/**
 * Fecha real de la ultima edicion del contenido: no la de hoy, sino la del
 * archivo de datos. Evita que la pagina diga "actualizado hoy" cada vez que
 * alguien la abre.
 */
function ultima_actualizacion(): int
{
    return (int) (@filemtime(RAIZ . '/data/contenido.php') ?: time());
}

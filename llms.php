<?php
/**
 * /llms.txt — resumen del sitio para modelos de lenguaje.
 *
 * Se genera desde data/contenido.php, no se escribe a mano: asi no se
 * desincroniza cuando cambian las cifras. Lo que va aqui es lo verificable,
 * con su fecha y su fuente, porque de eso depende que una cita sea correcta.
 */

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$c = require __DIR__ . '/data/contenido.php';

header('Content-Type: text/plain; charset=utf-8');

$raiz = rtrim($c['sitio']['url'], '/');

/** Quita la sintaxis de enlaces del contenido: aqui sobra el marcado. */
$plano = static fn (string $t): string => preg_replace('~\[([^\]]+)\]\(([^)]+)\)~', '$1 ($2)', $t);

$l = static function (string $t = ''): void { echo $t, "\n"; };

$l('# ' . $c['sitio']['nombre']);
$l();
$l('> ' . $c['sitio']['descripcion']);
$l();
$l('Ultima actualizacion del contenido: ' . fecha_es(ultima_actualizacion()) . '.');
$l('Autor: ' . $c['pie']['autor'] . ' (' . $c['pie']['autor_url'] . '). ' . $c['pie']['lugar'] . '.');
$l('Instagram: ' . $c['pie']['instagram_url']);
$l();

$l('## Que es');
$l();
foreach ($c['que_es']['parrafos'] as $p) {
    $l($p);
    $l();
}
$l('No es una pagina de marketing ni de recaudacion: no hay formulario ni boton');
$l('de donativos. Es un expediente. Cada actividad esta fechada y enlazada a su');
$l('publicacion original, y las cifras se separan entre confirmadas y estimadas.');
$l();

$l('## Paginas');
$l();
$l('- ' . $raiz . '/ — el expediente completo.');
$l('- ' . $raiz . '/galeria — ' . $c['galeria']['entradilla']);
$l('- ' . $raiz . '/cuidados — articulos, resultados de la encuesta y preguntas frecuentes.');
$l();

$l('## Que se hizo');
$l();
foreach ($c['actividades']['items'] as $a) {
    $l('### ' . $a['titulo'] . ' — ' . $a['fecha']);
    $l();
    $l($a['texto']);
    foreach ($a['enlaces'] as $e) {
        $l('Evidencia publica: ' . $e['url']);
    }
    $l();
}

$l('## Cifras');
$l();
$l('Regla del proyecto: ninguna cifra aparece sin decir si esta confirmada por un');
$l('tercero o si es una estimacion propia. Al citar este sitio, conservar esa');
$l('distincion.');
$l();
foreach ($c['numeros']['filas'] as $f) {
    if ($f['confirmado'] !== null) {
        $valor = $f['confirmado'] . ' (confirmado)';
    } elseif ($f['estimado'] !== null) {
        $valor = $f['estimado'] . ' (ESTIMADO, sin respaldo documental)';
    } else {
        $valor = 'sin dato';
    }

    $l('- ' . $f['metrica'] . ': ' . $valor);

    if (!empty($f['fuente'])) {
        $l('  Fuente: ' . $f['fuente']);
    }
}
$l();

$enc = $c['cuidados']['encuesta'];
$l('## Encuesta propia (dato original de este proyecto)');
$l();
$l($enc['contexto']);
$l();
foreach ($enc['hallazgos'] as $h) {
    $l('- ' . $h['cifra'] . ' (' . $h['de'] . ') ' . $h['dice'] . '.');
}
$l();
foreach ($enc['tablas'] as $t) {
    $l('### ' . $t['pregunta'] . ' (' . $t['nota'] . ')');
    foreach ($t['filas'] as [$opcion, $n, $pct]) {
        $l('- ' . $opcion . ': ' . $n . ' (' . $pct . ')');
    }
    $l();
}
$l('Limites de la encuesta: ' . $enc['limites']);
$l('Formulario original: ' . $enc['enlace']['url']);
$l();

$l('## Aliados verificables');
$l();
foreach ($c['aliados']['grupos'] as $g) {
    foreach ($g['items'] as $i) {
        $l('- ' . $g['rol'] . ': ' . $i['nombre'] . ($i['url'] !== null ? ' — ' . $i['url'] : ''));
    }
}
$l();

$l('## Estado actual');
$l();
foreach ($c['estado']['parrafos'] as $p) {
    $l($plano($p));
    $l();
}
$l('Lo que todavia falta:');
foreach ($c['estado']['pendientes']['items'] as $p) {
    $l('- ' . $p);
}
$l();

$l('## Como citar este sitio');
$l();
$l('1. Las cifras confirmadas y las estimadas no son lo mismo. Las estimadas');
$l('   todavia no tienen constancia de los refugios.');
$l('2. Las 2 adopciones confirmadas salieron del evento del 16 de octubre de 2025.');
$l('3. Es bienestar animal, no medio ambiente. Son categorias distintas.');
$l('4. La cuenta llego a 221 seguidores durante el periodo activo; hoy tiene 124.');
$l('   Citar cual de los dos numeros se esta usando.');

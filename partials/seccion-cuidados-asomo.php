<?php
/**
 * Asomo de /cuidados en la portada. No repite los articulos: los enumera y
 * manda a la pagina, que es donde viven.
 */
/** @var array $bloque */

$articulos = $bloque['articulos']['items'];
$preguntas = $bloque['preguntas']['items'];
?>
<section class="seccion seccion--cuidados-asomo" id="cuidados" aria-labelledby="cuidados-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['titulo'],
            'id'     => 'cuidados',
        ]); ?>

        <div class="seccion__contenido">
            <p class="prosa__destacado asomo__entrada"><?= e($bloque['entradilla']) ?></p>

            <ol class="asomo__lista">
                <?php foreach ($articulos as $articulo): ?>
                    <li>
                        <a class="asomo__enlace" href="/cuidados#articulo-<?= e($articulo['id']) ?>">
                            <span class="asomo__titulo"><?= e($articulo['titulo']) ?></span>
                            <span class="asomo__lede"><?= e($articulo['lede']) ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>

            <p class="asomo__salida">
                <a class="enlace-texto" href="/cuidados#encuesta">
                    Y los resultados de la encuesta: qué contestaron 45 personas
                </a>
            </p>

            <p class="asomo__salida asomo__salida--segunda">
                <a class="enlace-texto" href="/cuidados#preguntas">
                    Y <?= e((string) count($preguntas)) ?> preguntas frecuentes
                </a>
            </p>
        </div>

    </div>
</section>

<?php
/** @var array $bloque */
?>
<section class="seccion seccion--cuidados" id="articulos" aria-labelledby="articulos-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['articulos']['titulo'],
            'id'     => 'articulos',
            'canal'  => array_map(static fn (array $a): array => [
                'ancla' => 'articulo-' . $a['id'],
                'texto' => $a['titulo'],
                'fecha' => null,
            ], $bloque['articulos']['items']),
        ]); ?>

        <div class="seccion__contenido">
            <?php foreach ($bloque['articulos']['items'] as $articulo): ?>
                <article class="articulo" id="articulo-<?= e($articulo['id']) ?>">
                    <h3 class="articulo__titulo"><?= e($articulo['titulo']) ?></h3>
                    <p class="articulo__lede"><?= e($articulo['lede']) ?></p>

                    <div class="prosa">
                        <?php foreach ($articulo['parrafos'] as $parrafo): ?>
                            <p><?= enlazar_cuentas($parrafo) ?></p>
                        <?php endforeach; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<section class="seccion seccion--encuesta" id="encuesta" aria-labelledby="encuesta-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['encuesta']['titulo'],
            'id'     => 'encuesta',
        ]); ?>

        <div class="seccion__contenido">
            <p class="articulo__lede"><?= e($bloque['encuesta']['lede']) ?></p>

            <div class="prosa">
                <p><?= e($bloque['encuesta']['contexto']) ?></p>
            </div>

            <ol class="hallazgos">
                <?php foreach ($bloque['encuesta']['hallazgos'] as $h): ?>
                    <li class="hallazgo">
                        <p class="hallazgo__cifra"><?= e($h['cifra']) ?></p>
                        <p class="hallazgo__dice">
                            <?= e($h['dice']) ?>
                            <span class="hallazgo__de"><?= e($h['de']) ?></span>
                        </p>
                        <p class="hallazgo__lectura"><?= e($h['lectura']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>

            <?php foreach ($bloque['encuesta']['tablas'] as $tabla): ?>
                <div class="tabla-envoltura">
                    <table class="tabla-numeros tabla-encuesta">
                        <caption class="encuesta__pregunta">
                            <?= e($tabla['pregunta']) ?>
                            <span class="col__nota"><?= e($tabla['nota']) ?></span>
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col" class="col-metrica">Respuesta</th>
                                <th scope="col" class="col-confirmado">Personas</th>
                                <th scope="col" class="col-estimado">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabla['filas'] as [$opcion, $n, $pct]): ?>
                                <tr>
                                    <th scope="row" class="col-metrica">
                                        <span class="metrica__nombre"><?= e($opcion) ?></span>
                                    </th>
                                    <td class="col-confirmado" data-col="Personas">
                                        <span class="cifra cifra--confirmada"><?= e($n) ?></span>
                                    </td>
                                    <td class="col-estimado" data-col="Porcentaje">
                                        <span class="cifra cifra--texto cifra--confirmada"><?= e($pct) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>

            <p class="aviso"><?= e($bloque['encuesta']['limites']) ?></p>

            <p class="galeria__salida">
                <a class="enlace-texto" href="<?= e($bloque['encuesta']['enlace']['url']) ?>"
                   target="_blank" rel="noopener noreferrer"><?= e($bloque['encuesta']['enlace']['texto']) ?></a>
            </p>
        </div>

    </div>
</section>

<section class="seccion seccion--preguntas" id="preguntas" aria-labelledby="preguntas-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'titulo' => $bloque['preguntas']['titulo'],
            'id'     => 'preguntas',
        ]); ?>

        <div class="seccion__contenido">
            <p class="preguntas__nota"><?= e($bloque['preguntas']['nota']) ?></p>

            <dl class="preguntas">
                <?php foreach ($bloque['preguntas']['items'] as $par): ?>
                    <div class="pregunta">
                        <dt class="pregunta__p"><?= e($par['p']) ?></dt>
                        <dd class="pregunta__r"><?= enlazar_cuentas($par['r']) ?></dd>
                    </div>
                <?php endforeach; ?>
            </dl>

            <p class="aviso"><?= e($bloque['aviso']) ?></p>
        </div>

    </div>
</section>

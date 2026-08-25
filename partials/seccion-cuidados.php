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

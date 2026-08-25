<?php
/**
 * Columna izquierda de cada seccion. El titulo queda sticky mientras dura
 * la seccion; debajo, si el bloque lo aporta, va el canal (sub-indice).
 */
/** @var string $titulo */
/** @var string $id */
/** @var array|null $canal  Items ['ancla' => '#id', 'texto' => '...'] */
?>
<div class="seccion__cabecera">
    <h2 class="seccion__titulo" id="<?= e($id) ?>-titulo"><?= e($titulo) ?></h2>

    <?php if (!empty($canal)): ?>
        <nav class="canal" aria-label="Actividades de esta sección">
            <ol class="canal__lista">
                <?php foreach ($canal as $entrada): ?>
                    <li class="canal__item">
                        <a class="canal__enlace" href="#<?= e($entrada['ancla']) ?>">
                            <span class="canal__punto" aria-hidden="true"></span>
                            <span class="canal__etiquetas">
                                <span class="canal__texto"><?= e($entrada['texto']) ?></span>
                                <?php if (!empty($entrada['fecha'])): ?>
                                    <span class="canal__fecha"><?= e($entrada['fecha']) ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
    <?php endif; ?>
</div>

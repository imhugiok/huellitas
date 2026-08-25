<?php
/** @var array $bloque */
/** @var string $indice */
?>
<section class="seccion seccion--aliados" id="aliados" aria-labelledby="aliados-titulo">
    <div class="contenedor seccion__reja">

        <?php componente('cabecera-seccion', [
            'indice' => $indice,
            'titulo' => $bloque['titulo'],
            'id'     => 'aliados',
        ]); ?>

        <div class="seccion__contenido">
        <dl class="aliados">
            <?php foreach ($bloque['grupos'] as $grupo): ?>
                <div class="aliados__grupo">
                    <dt class="aliados__rol"><?= e($grupo['rol']) ?></dt>
                    <dd class="aliados__lista">
                        <?php foreach ($grupo['items'] as $item): ?>
                            <?php if ($item['url'] !== null): ?>
                                <a class="aliado" href="<?= e($item['url']) ?>" target="_blank" rel="noopener noreferrer">
                                    <?= e($item['nombre']) ?>
                                </a>
                            <?php else: ?>
                                <span class="aliado aliado--sin-enlace"><?= e($item['nombre']) ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </dd>
                </div>
            <?php endforeach; ?>
        </dl>

        </div>

    </div>
</section>

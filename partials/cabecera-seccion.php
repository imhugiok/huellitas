<?php
/** @var string $indice */
/** @var string $titulo */
/** @var string $id */
?>
<div class="seccion__cabecera">
    <p class="seccion__indice" aria-hidden="true"><?= e($indice) ?></p>
    <h2 class="seccion__titulo" id="<?= e($id) ?>-titulo"><?= e($titulo) ?></h2>
</div>

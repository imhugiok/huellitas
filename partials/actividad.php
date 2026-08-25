<?php
/** @var array $item */
/** @var string $numero */
/** @var bool $mostrarAnexosPendientes */

// Solo las imagenes que existen en disco. Si falta el archivo, no se dibuja
// un hueco roto: o se muestra el marcador o no se muestra nada.
$imagenes = [];

foreach ($item['imagenes'] as $imagen) {
    $archivo = foto($imagen['archivo']);

    if ($archivo !== null) {
        $imagenes[] = $imagen + $archivo;
    }
}
?>
<article class="actividad" id="actividad-<?= e($item['id']) ?>">

    <div class="actividad__fecha">
        <?php if ($item['fecha_iso'] !== null): ?>
            <time class="fecha" datetime="<?= e($item['fecha_iso']) ?>"><?= e($item['fecha']) ?></time>
        <?php else: ?>
            <span class="fecha"><?= e($item['fecha']) ?></span>
        <?php endif; ?>
    </div>

    <div class="actividad__cuerpo">
        <h3 class="actividad__titulo"><?= e($item['titulo']) ?></h3>
        <p class="actividad__texto"><?= enlazar_cuentas($item['texto']) ?></p>

        <?php if ($imagenes !== []): ?>
            <div class="laminas laminas--<?= count($imagenes) > 1 ? 'par' : 'sola' ?>">
                <?php foreach ($imagenes as $imagen): ?>
                    <figure class="lamina">
                        <img
                            src="<?= e($imagen['src']) ?>"
                            alt="<?= e($imagen['alt']) ?>"
                            <?= $imagen['ancho'] ? 'width="' . (int) $imagen['ancho'] . '"' : '' ?>
                            <?= $imagen['alto'] ? 'height="' . (int) $imagen['alto'] . '"' : '' ?>
                            loading="lazy" decoding="async">
                        <?php if (!empty($imagen['pie'])): ?>
                            <figcaption class="lamina__pie"><?= e($imagen['pie']) ?></figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php elseif ($mostrarAnexosPendientes && !empty($item['imagen_pendiente'])): ?>
            <?php /* Desaparece solo al dejar el archivo en /assets/img. Ver README. */ ?>
            <p class="anexo-pendiente">
                Anexo fotográfico pendiente
                <span class="anexo-pendiente__archivo">assets/img/<?= e($item['imagen_pendiente']) ?>.webp</span>
            </p>
        <?php endif; ?>

        <ul class="enlaces">
            <?php foreach ($item['enlaces'] as $enlace): ?>
                <li>
                    <a class="enlace-evidencia" href="<?= e($enlace['url']) ?>"
                       target="_blank" rel="noopener noreferrer">
                        <svg class="enlace-evidencia__icono" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <rect x="3.5" y="3.5" width="17" height="17" rx="5"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.2" cy="6.8" r="1.2" fill="currentColor" stroke="none"></circle>
                        </svg>
                        <span class="enlace-evidencia__texto"><?= e($enlace['texto']) ?></span>
                        <span class="visualmente-oculto">(abre Instagram en una pestaña nueva)</span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</article>

<?php
/**
 * Visor de fotos. Sin JS los enlaces siguen abriendo el archivo; con JS se
 * abre aqui dentro. El <dialog> nativo trae el fondo oscuro, el foco atrapado
 * y el cierre con Escape sin que haya que programarlos.
 */
?>
<dialog class="visor" aria-label="Foto ampliada">
    <button class="visor__cerrar" type="button" aria-label="Cerrar la foto">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M6 6l12 12M18 6L6 18"></path>
        </svg>
    </button>
    <img class="visor__foto" src="" alt="">
</dialog>

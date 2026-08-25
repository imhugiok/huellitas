<?php
/**
 * Visor de fotos. Sin JS los enlaces siguen abriendo el archivo; con JS se
 * abre aqui dentro. El <dialog> nativo trae el fondo oscuro, el foco atrapado
 * y el cierre con Escape sin que haya que programarlos.
 */
?>
<dialog class="visor" aria-label="Foto ampliada">
    <button class="visor__flecha visor__flecha--previa" type="button" aria-label="Foto anterior">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M15 4L7 12l8 8"></path>
        </svg>
    </button>

    <img class="visor__foto" src="" alt="">

    <button class="visor__flecha visor__flecha--siguiente" type="button" aria-label="Foto siguiente">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M9 4l8 8-8 8"></path>
        </svg>
    </button>

    <button class="visor__cerrar" type="button" aria-label="Cerrar la foto">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M6 6l12 12M18 6L6 18"></path>
        </svg>
    </button>

    <p class="visor__cuenta" aria-live="polite"></p>
</dialog>

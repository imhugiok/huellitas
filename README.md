# huellitas.hugorivera.me

Página de evidencia de Huellitas al Corazón. PHP plano, sin build, sin Composer,
sin Node. Se sube por FTP y funciona.

---

## Cómo editar el contenido

Todo el texto, las cifras y los enlaces viven en **un solo archivo**:

```
data/contenido.php
```

Las plantillas de `/partials` no contienen texto de contenido. Si quieres cambiar
una cifra, agregar una actividad o corregir una fecha, ese es el único archivo
que tocas.

### Agregar una actividad nueva

En `data/contenido.php`, dentro de `actividades.items`, copia un bloque y ajusta:

```php
[
    'id'        => 'nombre-corto',              // ancla: #actividad-nombre-corto
    'corto'     => 'Etiqueta',                  // lo que sale en el canal lateral
    'titulo'    => 'Título de la actividad',
    'fecha'     => '3 de marzo de 2027',        // como se lee en pantalla
    'fecha_iso' => '2027-03-03',                // para buscadores; null si no hay fecha exacta
    'texto'     => 'Una o dos líneas.',
    'imagenes'  => [                            // 1 foto = ancho completo, 2 = lado a lado
        [
            'archivo' => 'nombre-archivo',      // busca assets/img/nombre-archivo.webp
            'alt'     => 'Descripción real de la foto.',
            'pie'     => 'Qué prueba esta foto.',
        ],
    ],
    'imagen_pendiente' => 'nombre-archivo',     // opcional: marcador mientras no haya foto
    'enlaces'   => [
        ['url' => 'https://www.instagram.com/p/XXXXXXXX/', 'texto' => 'Publicación'],
    ],
],
```

`corto` es la etiqueta que aparece en el canal lateral de la sección (el
sub-índice que marca en qué actividad va el lector). Que sea corta de verdad:
dos palabras como mucho, o se parte en la columna.

El `pie` de cada foto no es decorativo: es donde se dice qué prueba la imagen.
La foto de los insumos, por ejemplo, es la que respalda los 6 kg de croqueta de
la tabla.

### Agregar una fila a la tabla de números

`numeros.filas`. Cada fila tiene tres campos que importan:

- `confirmado`: solo si un tercero puede corroborarlo hoy. Si no, `null`.
- `estimado`: tu cálculo. Si no lo tienes, `null`.
- `fuente`: quién lo confirma o por qué sigue pendiente. **No lo dejes vacío.**

La regla del proyecto es que ninguna cifra aparece sin decir de cuál de las dos
columnas es. El diseño depende de eso, no lo rompas.

Los títulos y subtítulos de las columnas están en `numeros.cabeceras`. Pon
`'nota' => null` para que una columna no lleve subtítulo.

---

## Las fotos

Cada actividad busca su imagen en `assets/img/<slug>.webp` (también acepta
`.jpg`, `.jpeg`, `.png`). Mientras el archivo no exista, la página dibuja un
recuadro que dice qué archivo falta. **En cuanto dejes la imagen ahí, el
recuadro desaparece solo.** No hay que tocar código.

Ya puestas, sacadas de `portafolio-nuevo/public/media/huellitas`:

| Archivo | Bloque |
|---|---|
| `evento-yoga.webp` | Evento de adopción responsable |
| `entregas-compra.webp` + `entregas-insumos.webp` | Entregas recurrentes a refugios |

Faltan dos:

| Archivo | Bloque |
|---|---|
| `assets/img/investigacion-refugios.webp` | Investigación de campo en refugios |
| `assets/img/venta-bolis.webp` | Venta con causa en una feria |

**Descartadas por la regla de no mostrar caras identificables:**
`adopcion-cachorro-01`, `adopcion-cachorro-02` y `croqueta-campeon` del
portafolio. Las tres tienen rostros de terceros en primer plano. Si consigues
autorización de las personas que salen, se pueden usar; mientras no, no.

También quedaron fuera las cuatro imágenes `Publicaciones Huellitas Al Corazon`
de Descargas: son gráficos promocionales con fotos de husky de banco de
imágenes, y el brief prohíbe stock. Además llevan la URL vieja
`byhugiok.com/ayudando-perritos`.

Recomendado: 1200 px de ancho, proporción 3:2, formato WebP. Para convertir:

```bash
ffmpeg -i foto.jpg -vf scale=1200:-1 -c:v libwebp -quality 82 evento-yoga.webp
```

Recuerda las reglas del proyecto: **sin caras identificables** (solo perros,
manos, planos generales), sin fotos de stock, sin logos de los refugios.

Si prefieres que los huecos no se noten mientras consigues las fotos, pon
`'mostrar_anexos_pendientes' => false` en `data/contenido.php`.

---

## Subir a Hostinger

1. En hPanel, crea el subdominio `huellitas.hugorivera.me`. Hostinger genera una
   carpeta, normalmente `public_html/huellitas` o similar.
2. Sube **todo** el contenido de esta carpeta ahí dentro, respetando la
   estructura (`data/`, `lib/`, `partials/`, `assets/`, `index.php`, `.htaccess`).
   El `.htaccess` empieza con punto: revisa que tu cliente FTP muestre archivos
   ocultos.
3. En hPanel: activa el certificado SSL del subdominio y la opción **Forzar
   HTTPS**.
4. PHP 8.1 o superior (usa `declare(strict_types=1)`, arrow functions y
   `match`-era syntax). Hostinger trae 8.2 por defecto.

No hay nada que instalar. No hay `composer install`, no hay `npm run build`.

### Deploy automático desde GitHub

El repo es <https://github.com/imhugiok/huellitas>. Cada push a `main` dispara
`.github/workflows/deploy.yml`, que valida la sintaxis de todos los PHP y sube
el sitio por FTPS.

Mientras falten los secrets el workflow termina en verde sin publicar nada, así
que no ensucia el historial. Para encenderlo, en **Settings → Secrets and
variables → Actions** del repo:

| Secret | Qué es |
|---|---|
| `FTP_SERVIDOR` | Host FTP que da hPanel |
| `FTP_USUARIO` | Usuario FTP del subdominio |
| `FTP_PASSWORD` | Su contraseña |

Y si hPanel te dio una carpeta distinta de `public_html/huellitas/`, ponla como
**variable** (no secret) llamada `FTP_RUTA`.

### Comprobación después de subir

- `https://huellitas.hugorivera.me/` carga.
- `https://huellitas.hugorivera.me/data/contenido.php` da **403**. Si muestra
  código, el `.htaccess` no se subió.
- `https://huellitas.hugorivera.me/sitemap.xml` devuelve XML.

---

## Probar en local

Con XAMPP ya instalado:

```bash
cd huellitas.hugorivera.me
C:/xampp/php/php -S 127.0.0.1:8765 -t .
```

Y abre <http://127.0.0.1:8765/>.

Ojo: el servidor de PHP no lee `.htaccess`, así que en local `/sitemap.xml` no
funciona (usa `/sitemap.php`) y las carpetas protegidas sí son accesibles. Eso
solo pasa en local.

---

## Estructura

```
index.php              entrada; arma la página y manda la CSP con nonce
sitemap.php            sitemap con la fecha real del contenido
.htaccess              HTTPS, cabeceras, caché, bloqueo de carpetas
robots.txt

data/contenido.php     TODO el contenido. El único archivo que sueles editar.
lib/helpers.php        escapado, componentes, cache-busting de assets
partials/              componentes de la vista (sin texto de contenido)
assets/css/site.css    hoja única, con tokens al inicio
assets/js/site.js      mejora progresiva; la página funciona sin JS
assets/img/            logo.svg (el real, insertado en línea y coloreado por
                       CSS), og.png, iconos y fotos de las actividades
```

### Decisiones que conviene no deshacer

- **Sin framework.** Laravel para una página de evidencia significa mantener
  30 MB de dependencias para renderizar un documento que cambia dos veces al año.
- **CSP con nonce desde PHP.** Por eso `site.js` no escribe estilos en línea y
  el escalonado de las animaciones está en CSS.
- **`asset()` mete `?v=hash`** en cada URL, y por eso `.htaccess` puede cachear
  los assets un año sin dejarte con CSS viejo tras un deploy.
- **La fecha del pie sale de `filemtime()` de `contenido.php`**, no de `date()`.
  Así la página nunca dice "actualizado hoy" solo porque alguien la abrió.
- **La zona horaria se fija en `helpers.php`** (`America/Mexico_City`). Sin eso
  el servidor decide: Hostinger sirve en UTC y el pie anunciaba el día siguiente
  desde las seis de la tarde, hora de Guadalajara.
- **Una sola familia tipográfica.** Los metadatos (fechas, folios, roles) se
  distinguen por tamaño, versalitas y tracking, no por cambiar a monoespaciada.
- **El logo va en línea, no como `<img>`.** El SVG usa `fill="currentColor"`,
  así que hereda el color del CSS y no cuesta una petición extra.

---

## Cambiar el aspecto

Los tokens están arriba de `assets/css/site.css`, en `:root`. Cambiando esas
variables cambia todo el sitio:

- `--acento: #fd5700` es el naranja del logo. Se usa solo en elementos grandes o
  decorativos.
- `--acento-tinta: #b83c00` es la versión que sí pasa contraste AA para texto
  pequeño (5.4:1 sobre el papel). Si cambias el acento, calcula esta también.
- `--papel`, `--tinta`, `--tinta-2`, `--tinta-3`: todos verificados contra AA.

---

## Pendientes del proyecto (no del código)

- Constancias por escrito de `@patitas_porbimba` y `@propatitasgdl` (mensajes
  enviados, sin respuesta).
- Constancia del evento del 16 de octubre, por solicitar a Tecmilenio.
- Confirmar con el refugio si las 2 adopciones salieron del yoga o de redes.
- Las dos fotos que faltan.
- Confirmar si el nombre de perfil de Instagram ya se cambió de "ByHugiok".

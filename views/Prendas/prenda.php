<?php
require_once __DIR__ . '/../../includes/templates/boton_whatsapp.php';
?>

<main class="contenedor seccion contenido-centrado">
    <a href="/prendas" class="boton boton-verde">Volver</a>

    <h1><?php echo htmlspecialchars($prenda->titulo); ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $prenda->imagen; ?>" alt="imagen de la prenda">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo number_format($prenda->precio); ?> mx</p>

        <div class="detalles-producto">
            <p><?php echo nl2br(htmlspecialchars($prenda->descripcion)); ?></p>
        </div>

        <div class="botones-producto">
            <?php mostrarBotonWhatsApp($prenda, 'prenda'); ?>
        </div>
    </div>
</main> 
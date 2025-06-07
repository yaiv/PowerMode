<?php
require_once __DIR__ . '/../../includes/templates/boton_whatsapp.php';
?>

<main class="contenedor seccion">
<a href="/" class="boton boton-verde">volver</a>

    <h1 class="titulo-seccion">Suplementos Alimenticios</h1>
    <p class="parrafo-seccion">Descubre los mejores suplementos alimenticios para maximizar tu rendimiento y mejorar tu salud.</p>

    <div class="contenedor-anuncios">
        <?php foreach($suplementos as $suplemento){ ?>
        <div class="tarjeta-producto">
            <img class="img-anuncios" src="/imagenes/<?php echo $suplemento->imagen;?>" alt="<?php echo htmlspecialchars($suplemento->titulo); ?>">
            
            <div class="resumen-propiedad">
                <h3><?php echo htmlspecialchars($suplemento->titulo); ?></h3>
                
                <div class="detalles-producto">
                    <div class="iconos-caracteristicas">
                        <li>
                            <p class="precio">Precio: $<?php echo number_format($suplemento->precio); ?> mx</p> 
                        </li>
                    </div>
                </div>

                <div class="botones-producto">
                    <a href="/suplemento?id=<?php echo $suplemento->id; ?>" >Ver Producto</a>
                    <?php mostrarBotonWhatsApp($suplemento, 'suplemento'); ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main> 
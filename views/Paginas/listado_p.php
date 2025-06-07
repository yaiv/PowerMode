<?php
require_once __DIR__ . '/../../includes/templates/boton_whatsapp.php';
require_once __DIR__ . '/../../includes/funciones.php';
?>

<main>
    <div class="contenedor-anuncios">
        <?php foreach($prendas as $prenda){ ?>
        <div class="tarjeta-producto">
            <img class="img-anuncios" src="/imagenes/<?php echo $prenda->imagen;?>" alt="<?php echo htmlspecialchars($prenda->titulo); ?>">
            
            <div class="resumen-propiedad">
                <h3><?php echo htmlspecialchars($prenda->titulo); ?></h3>
                
                <div class="detalles-producto">

                <div class="iconos-caracteristicas">
                    <li>
                        Precio: $<?php echo number_format($prenda->precio); ?> mx
                    </li>
                </div>

                </div>

                <div class="botones-producto">
                    <a href="/prenda?id=<?php echo $prenda->id; ?>" >Ver Producto</a>
                    <?php mostrarBotonWhatsApp($prenda, 'prenda'); ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
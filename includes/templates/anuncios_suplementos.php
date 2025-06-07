<?php 

use App\Suplemento;
require_once __DIR__ . '/boton_whatsapp.php';

if ($_SERVER['SCRIPT_NAME'] === '/anuncios_suplementos.php'){
    $suplementos = Suplemento::all();
} else {
    $suplementos = Suplemento::get(4);
}

?>        

<main>
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
                    <a href="anuncio_suplemento.php?id=<?php echo $suplemento->id; ?>" >Ver Producto</a>
                    <?php mostrarBotonWhatsApp($suplemento, 'suplemento'); ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
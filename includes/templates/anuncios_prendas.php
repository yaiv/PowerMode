<?php 

use App\Prenda;
require_once __DIR__ . '/boton_whatsapp.php';

if ($_SERVER['SCRIPT_NAME'] === '/anuncios_prendas.php'){
    $prendas = Prenda::all();
} else {
    $prendas = Prenda::get(4);
}

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
                            <p class="precio">Precio: $<?php echo number_format($prenda->precio); ?> mx</p> 
                        </li>
                    </div>
                </div>

                <div class="botones-producto">
                    <a href="anuncio_prenda.php?id=<?php echo $prenda->id; ?>" >Ver Producto</a>
                    <?php mostrarBotonWhatsApp($prenda, 'prenda'); ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
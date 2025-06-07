<?php
require_once __DIR__ . '/../../includes/templates/boton_whatsapp.php';
?>

<main class="contenedor seccion">
    <div class="tarjeta-producto">
        <img class="img-anuncios" loading="lazy" src="/imagenes/<?php echo $prenda->imagen;?>" alt="imagen de la prenda">
        
        <div class="resumen-propiedad">
            <h2><?php echo $prenda->titulo;?></h2>

            <div class="detalles-producto">
                <p><strong>Marca:</strong> <?php echo $prenda->marca;?></p>
                <p><strong>Color:</strong> <?php echo $prenda->color;?></p>
                <p><strong>Descripción:</strong> <?php echo $prenda->descripcion;?></p>
                
                <?php if(!empty($prenda->tallas)): ?>
                    <p class="tallas-disponibles"><strong>Tallas disponibles:</strong> 
                        <?php 
                            $tallasDisponibles = explode(',', $prenda->tallas);
                            $tallasLimpias = array();

                            foreach ($tallasDisponibles as $talla) {
                                $talla = trim($talla);
                                if(!empty($talla)) {
                                    $tallasLimpias[] = str_replace(['[', ']','"'], '', $talla);
                                }
                            }

                            // Generar con comas correctamente posicionadas
                            foreach($tallasLimpias as $index => $talla) {
                                echo "<span class='talla'>" . htmlspecialchars($talla);
                                if($index < count($tallasLimpias) - 1) {
                                    echo ",";
                                }
                                echo "</span>";
                                if($index < count($tallasLimpias) - 1) {
                                    echo " ";
                                }
                            }
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <ul class="iconos-caracteristicas">
               <li>
                     <p class="precio">Precio: $<?php echo number_format($prenda->precio); ?> mx</p>
                </li>
            </ul>

            <div class="botones-producto">
                <?php mostrarBotonWhatsApp($prenda, 'prenda'); ?>
                <a href="/prendas" class="boton-amarillo-block">Volver</a>

            </div>

        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/../../includes/templates/boton_whatsapp.php';
?>

<main class="contenedor seccion">
    <div class="tarjeta-producto">
        <img class="img-anuncios" loading="lazy" src="/imagenes/<?php echo $suplemento->imagen;?>" alt="<?php echo htmlspecialchars($suplemento->titulo); ?>">
        
        <div class="resumen-propiedad">
            <h2><?php echo htmlspecialchars($suplemento->titulo); ?></h2>

            <div class="detalles-producto">
                <p><strong>Marca:</strong> <?php echo htmlspecialchars($suplemento->marca); ?></p>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($suplemento->tipo); ?></p>
                <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($suplemento->descripcion)); ?></p>
                
                <?php if(!empty($suplemento->sabores)): ?>
                    <div class="sabores-disponibles">
                        <p><strong>Sabores disponibles:</strong></p>
                        <div class="lista-sabores">
                            <?php 
                                $saboresDisponibles = explode(',', $suplemento->sabores);
                                foreach ($saboresDisponibles as $sabor) {
                                    $sabor = trim($sabor);
                                    if(!empty($sabor)) {
                                        echo "<span class='sabor'>" . htmlspecialchars(str_replace(['[', ']','"'], '', $sabor)) . "</span>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <ul class="iconos-caracteristicas">
                <li>
                    <p class="precio">Precio: $<?php echo number_format($suplemento->precio); ?> mx</p>
                </li>
            </ul>

            <div class="botones-producto">
                <?php mostrarBotonWhatsApp($suplemento, 'suplemento'); ?>
                <a href="/suplementos" class="boton-amarillo-block">Volver</a>
            </div>
        </div>
    </div>
</main>

<style>
    .sabores-disponibles {
        margin-top: 1rem;
    }

    .lista-sabores {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .sabor {
        background-color: var(--gris);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 700;
    }
</style> 
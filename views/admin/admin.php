<main class="contenedor seccion">
    <h1 class="titulo-seccion">Administrador Power Mode</h1>

    <?php 
        if($resultado){
            $mensaje = mostrarNotificacion( intval($resultado) );
            if($mensaje){ ?>
                <p class="alerta exito"><?php echo s($mensaje)  ?></p>
            <?php }
        }
    ?>

    <div class="botones-admin">
        <a href="/prendas/crear" class="boton boton-verde">Registrar Ropa</a>
        <a href="/suplementos/crear" class="boton boton-amarillo">Registrar Suplemento</a>
    </div>

    <h2 class="titulo-seccion">Ropa Deportiva</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $prendas as $prenda): ?> 
                <tr>
                    <td> <?php echo $prenda->id; ?> </td>
                    <td> <?php echo $prenda->titulo; ?> </td>
                    <td> <img src="/imagenes/<?php echo $prenda->imagen; ?>" class="imagen-tabla"> </td>
                    <td>$ <?php echo $prenda->precio; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/prendas/eliminar">
                            <input type="hidden" name="id" value="<?php echo $prenda->id; ?>" >
                            <input type="hidden" name="tipo" value="prenda" >
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/prendas/actualizar?id=<?php echo $prenda->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="titulo-seccion">Suplementos</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $suplementos as $suplemento): ?> 
                <tr>
                    <td> <?php echo $suplemento->id; ?> </td>
                    <td> <?php echo $suplemento->titulo; ?> </td>
                    <td> <img src="/imagenes/<?php echo $suplemento->imagen; ?>" class="imagen-tabla"> </td>
                    <td>$ <?php echo $suplemento->precio; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/suplementos/eliminar">
                            <input type="hidden" name="id" value="<?php echo $suplemento->id; ?>" >
                            <input type="hidden" name="tipo" value="suplemento" >
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/suplementos/actualizar?id=<?php echo $suplemento->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main> 
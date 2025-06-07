<fieldset>
    <legend>Informacion General:</legend>

    <label for="titulo">Nombre:</label>
    <input type="text" id="titulo" name="suplemento[titulo]" placeholder="Nombre del producto" value="<?php echo s($suplemento->titulo ?? ''); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="suplemento[precio]" placeholder="Precio del producto:" value="<?php echo s($suplemento->precio ?? ''); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="suplemento[imagen]">

    <?php if(isset($suplemento->imagen) && $suplemento->imagen): ?>
        <img src="/imagenes/<?php echo $suplemento->imagen; ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" placeholder="Ingresa caracteristicas del producto:" name="suplemento[descripcion]"><?php echo s($suplemento->descripcion ?? ''); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion del Suplemento</legend>

    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="suplemento[marca]" placeholder="Nutrisport, Nutrytec, etc..." value="<?php echo s($suplemento->marca ?? ''); ?>">
    
    <label for="tipo">Tipo:</label>
    <input type="text" id="tipo" name="suplemento[tipo]" placeholder="Creatina, proteina, etc" value="<?php echo s($suplemento->tipo ?? ''); ?>">
</fieldset> 
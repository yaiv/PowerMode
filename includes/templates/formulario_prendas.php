<fieldset>
    <legend>Informacion General:</legend>

    <label for="titulo">Nombre:</label>
    <input type="text" id="titulo" name="prenda[titulo]" placeholder="Leggings, tops, etc.." value="<?php echo s($prenda->titulo ?? ''); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="prenda[precio]" placeholder="Precio del producto:" value="<?php echo s($prenda->precio ?? ''); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="prenda[imagen]">

    <?php if(isset($prenda->imagen) && $prenda->imagen): ?>
        <img src="/imagenes/<?php echo $prenda->imagen; ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion"  placeholder="Ingresa caracteristicas del producto:" name="prenda[descripcion]"><?php echo s($prenda->descripcion ?? ''); ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion de la Prenda</legend>

    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="prenda[marca]" placeholder="Alo, Gymshark, etc..." value="<?php echo s($prenda->marca ?? ''); ?>">
    
    <label for="color">Color:</label>
    <input type="text" id="color" name="prenda[color]" placeholder="Color" value="<?php echo s($prenda->color ?? ''); ?>">
    
    <div class="tallas-container">
        <legend>Disponibilidad de Tallas:</legend>
        <div class="tallas-opciones">
            <label>
                <input type="checkbox" name="prenda[tallas][]" value="chica" 
                    <?php echo in_array('chica', explode(',', $prenda->tallas ?? '')) ? 'checked' : ''; ?>>
                <span>Chica</span>
            </label>
            
            <label>
                <input type="checkbox" name="prenda[tallas][]" value="mediana" 
                    <?php echo in_array('mediana', explode(',', $prenda->tallas ?? '')) ? 'checked' : ''; ?>>
                <span>Mediana</span>
            </label>
            
            <label>
                <input type="checkbox" name="prenda[tallas][]" value="grande" 
                    <?php echo in_array('grande', explode(',', $prenda->tallas ?? '')) ? 'checked' : ''; ?>>
                <span>Grande</span>
            </label>
        </div>
    </div>
</fieldset>

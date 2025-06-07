<?php
// Constantes de configuración
define('WHATSAPP_NUMERO', '5215551464297');
define('DOMINIO_PRODUCCION', 'powermode.com.mx'); // Cambiar al dominio real de producción

// Función para validar el producto
function validarProducto($producto, $tipo) {
    if (!is_object($producto)) {
        return false;
    }

    $camposRequeridos = ['titulo', 'marca', 'precio', 'id'];
    $camposEspecificos = [
        'prenda' => ['color'],
        'suplemento' => ['tipo']
    ];

    // Validar campos requeridos
    foreach ($camposRequeridos as $campo) {
        if (!isset($producto->$campo) || empty($producto->$campo)) {
            return false;
        }
    }

    // Validar campos específicos según el tipo
    if (isset($camposEspecificos[$tipo])) {
        foreach ($camposEspecificos[$tipo] as $campo) {
            if (!isset($producto->$campo) || empty($producto->$campo)) {
                return false;
            }
        }
    }

    return true;
}

// Función para generar el mensaje de WhatsApp
function generarMensajeWhatsApp($producto, $tipo) {
    // Validar tipo de producto
    if (!in_array($tipo, ['prenda', 'suplemento'])) {
        return false;
    }

    // Validar producto
    if (!validarProducto($producto, $tipo)) {
        return false;
    }
    
    // Emojis específicos según el tipo de producto
    $emojis = [
        'prenda' => [
            'titulo' => '👕',
            'tipo' => '🎨 Color'
        ],
        'suplemento' => [
            'titulo' => '💊',
            'tipo' => '🔬 Tipo'
        ]
    ];
    
    $emoji = $emojis[$tipo];
    
    try {
        // Crear mensaje base con formato correcto para WhatsApp
        $mensajeBase = "Hola! Me interesa este producto:\n\n";
        $mensajeBase .= $emoji['titulo'] . " *" . htmlspecialchars_decode($producto->titulo) . "*\n";
        $mensajeBase .= "🏷️ Marca: " . htmlspecialchars_decode($producto->marca) . "\n";
        $mensajeBase .= "💰 Precio: $" . number_format($producto->precio) . "\n";
        
        if (!empty($producto->descripcion)) {
            // Limitar la descripción y asegurar que no rompa el formato
            $descripcion = htmlspecialchars_decode(substr($producto->descripcion, 0, 100));
            $mensajeBase .= "📝 " . $descripcion . "...\n";
        }
        
        // Agregar campo específico según el tipo
        if ($tipo === 'prenda') {
            $mensajeBase .= $emoji['tipo'] . ": " . htmlspecialchars_decode($producto->color) . "\n";
        } else {
            $mensajeBase .= $emoji['tipo'] . ": " . htmlspecialchars_decode($producto->tipo) . "\n";
        }
        
        $mensajeBase .= "\n¿Está disponible?, me interesa comprarlo\n";
        
        // Obtener la URL base según el entorno
        $dominio = $_SERVER['HTTP_HOST'];
        // Si estamos en localhost, usar el dominio de producción
        if ($dominio === 'localhost:8000' || $dominio === 'localhost') {
            $dominio = DOMINIO_PRODUCCION;
        }
        
        // Obtener la URL completa usando las rutas amigables
        $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $ruta = $tipo === 'prenda' ? 'prenda' : 'suplemento';
        $urlCompleta = $protocolo . "://" . $dominio . "/" . $ruta . "?id=" . $producto->id;
        $mensajeBase .= "Link: " . $urlCompleta;
        
        // Codificar el mensaje para URL de manera segura
        $mensajeCodificado = urlencode($mensajeBase);
        
        // Crear enlace de WhatsApp usando la API oficial
        return "https://wa.me/" . WHATSAPP_NUMERO . "?text=" . $mensajeCodificado;

    } catch (Exception $e) {
        // Log del error si es necesario
        return false;
    }
}

// Función para mostrar el botón
function mostrarBotonWhatsApp($producto, $tipo) {
    $enlaceWhatsApp = generarMensajeWhatsApp($producto, $tipo);
    
    if ($enlaceWhatsApp === false) {
        // Si hay error, mostrar un mensaje o botón alternativo
        return '<p class="error">No se pudo generar el enlace de WhatsApp</p>';
    }
    
    ?>
    <a href="<?php echo htmlspecialchars($enlaceWhatsApp); ?>" 
       class="boton-amarillo-block" 
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Contactar por WhatsApp">
        Comprar
    </a>
    <?php
}
?> 
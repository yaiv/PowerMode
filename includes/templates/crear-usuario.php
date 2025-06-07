<?php
   //Importar la conexion a traves de .php
    require 'includes/app.php';
    $db = conectarDB();

    // Verifica si el formulario fue enviado
    $mensaje = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recupera y sanitiza los datos del formulario
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Validaciones
        if(!$email) {
            $mensaje[] = "El correo es obligatorio";
        }
        
        if(!$password) {
            $mensaje[] = "La contraseña es obligatoria";
        }
        
        if(empty($mensaje)) {
            // Verificar si el correo ya existe en la base de datos
            $queryVerificar = "SELECT * FROM usuarios WHERE email = '{$email}'";
            $resultadoVerificar = mysqli_query($db, $queryVerificar);
            
            if(mysqli_num_rows($resultadoVerificar) > 0) {
                $mensaje[] = "El email ya está registrado";
            } else {
                // Hashear la contraseña
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                
                // Query para crear el usuario 
                $query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}')";
                
                // Insertarlo a la BD 
                $resultado = mysqli_query($db, $query);
                
                if($resultado) {
                    $mensaje[] = "Usuario creado correctamente";
                } else {
                    $mensaje[] = "Error al crear el usuario: " . mysqli_error($db);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <div class="contenedor">
        <h1>Crear Nuevo Usuario</h1>
        
        <?php foreach($mensaje as $msg): ?>
            <div class="alerta">
                <?php echo $msg; ?>
            </div>
        <?php endforeach; ?>
        
        <form method="POST">
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" required>
            </div>
            
            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña" required>
            </div>
            
            <input type="submit" value="Crear Usuario" class="boton">
        </form>
        
        <a href="/admin/index.php" class="boton">Volver</a>
    </div>
</body>
</html>
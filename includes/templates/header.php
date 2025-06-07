<?php

    //Se verifica si ya existe la sesion
    if(!isset($_SESSION)){
        //Se trae informacion de la sesion del usuario que se almaceno
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>"> <!--Se evalua inicio, si esta variable esta como true se agrega el string de inicio y en caso contrario sera un string vacio (operador ternario)
        Se hace uso de isset ya que la funcion nos permite revisar si es una variable definida -->
        <div class="contenedor contenido-header">
            <div class="barra">
        <a href="/" class="logo">
            <svg width="100%" height="150" viewBox="0 0 1000 150" xmlns="http://www.w3.org/2000/svg">
              <style>
                .bebas { font-family: 'Bebas Neue', sans-serif; fill: white; }

              </style>
            
              <!-- Fondo negro -->
            
            
              <!-- Texto "POWER MODE" -->
              <text x="50" y="110" font-size="100" class="bebas">
                <tspan class="bold">POWER</tspan>
                <tspan class="bold" dx="30">MODE</tspan>
              </text>
            </svg>

        </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton dark mode">
                    <nav class="navegacion">

                        <?php if(!$auth): ?>
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios_prendas.php">Prendas</a>
                        <a href="anuncios_suplementos.php">Suplementos</a>
                        <a href="login.php">Iniciar Sesión</a>
                        <?php else:  ?>
                            <a href="/admin/index.php">Administrar</a>
                            <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                             
                        <?php endif; ?>
                    </nav>
                </div>
                
            </div>  <!--Cierre de barra -->

            <?php 
                if($inicio){
                    echo "<h1>Ropa Deportiva y Suplementos Alimenticios </h1>";
                }
             
            ?>

        </div> 
    </header>
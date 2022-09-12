<?php 
include 'config.php';
include("database.php");
$id = "SELECT * FROM productos";
 include ("header.php");
$di = isset ($_GET['id']) ? $_GET['id'] : '';
$token = isset ($_GET['token']) ?$_GET['token'] : ''; //ESTO ANDA

if($di == '' || $token == ''){
    echo 'ERROR';
    exit;
}//ESTO ANDA
 else {
    $token_tmp = hash_hmac('sha1', $di, KEY_TOKEN);
    if($token == $token_tmp){//ROMPE
        $sql = $conexion->prepare("SELECT (id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$di]);
        
        $totalFilas=$stmt->fetchColumn();

        if ($sql->$totalFilas > 0){

            $sql = $conexion->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$di]);
            $row=$sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];

        }

    } else {
        echo ('ERROR tOKEN');
    }// ESTO ANDA
 }


 ?>

<main>
<div class="container">
    <div class="row"><!--row=fila-->
    <div class="col-md-6 order-md-1"><!--dividimos a la mitad y la fila 1-->
      <img src="imagenes/productos/1/principal.jpg">
    </div>
    <div class="col-md-6 order-md-2"><!--dividimos a la mitad y la posicion 2-->
        <h2><?php echo $nombre; ?></h2>
    </div>
    </div>





</div>
</main>



 
<?php 

include ("header.php");
include("database.php");
include 'config.php';
$id = "SELECT * FROM productos";
@$mysqli_stmt;


$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id == '' || $token == ''){
    echo 'Error al procesar la solicitud';
    exit;
    }
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp){
 
$mysqli_stmt = $conexion -> prepare('SELECT count(id) FROM productos WHERE id=? AND activo=1 LIMIT 1');
$mysqli_stmt->execute([$id]);
$rows = $mysqli_stmt::fetchColum(6);

}
}











 ?>

  <main>
  <div class="container">
     <div class="col-md-6 order-md-1">
        <img src="imagenes/productos/1/principal.jpg">
     </div>

     <div class="col-md-6 order-md-2">
        <h2><?php echo $nombre; ?></h2>
        <h2><?php echo MONEDA . number_format ($precio, 2, '.', ','); ?></h2>
      </div>

    </div>
  </main>





<?php include ("footer.php"); ?>
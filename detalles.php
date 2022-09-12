<?php 
include 'config.php';
include 'header.php';
include 'database.php';

$id = "SELECT * FROM productos";



$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id == '' || $token == ''){
    echo 'Error al procesar la solicitud';
    exit;

} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp){
 
$sql = $conexion -> prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1 LIMIT 1");
$sql->execute([$id]);

if($sql->PDOStatement::fetchColumn() > 0){

         $sql = $conexion -> prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1");
          $sql->execute([$id]);
          $row = $sql->fetch(PDO::FETCH_ASSOC);
          $nombre = $row['nombre'];
          $descripcion = $row['descripcion'];
          $precio = $row['precio'];
          $descuento = $row['descuento'];
          $precio_desc = $precio - (($precio * $descuento) / 100); //esto es una variable definida
          $dir_images = 'imagenes/productos/' . $id . '/';

          $rutaImg = $dir_images . 'principal.jpg';
          if(!file_exists($rutaImg)){
            $rutaImg = 'imagenes/no-photo.jpg';

          }
             $imagenes = array();
             if(file_exists($dir_images)){
             $dir = dir($dir_images);
                  while(($archivo = $dir->read()) != false){
                     if($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                        $imagenes[] = $images;
                        $images = $dir_images . $archivo;
                     }
                  }
                    $dir->close();
          } else {
          echo 'Error al procesar la solicitud';
          exit;
                }
        } else {
          echo 'Error al procesar la solicitud';
          exit;
        }
      }
    }
  }
 ?>

  <main>
  <div class="container">
    <div class="row">
     <div class="col-md-6 order-md-1">

<div id="carouselImg" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $rutaImg;?>" class="d-block w-100" ><!--d block w100 hace q tenga tamaño 100 y sean las imagenes tmaño igual-->
    </div>

 <?php 

 {
  $imagenes = array();
     foreach($imagenes as $img) { ?>
    <div class="carousel-item">
      <img src="<?php echo $img;?>" class="d-block w-100" ><!--d block w100 hace q tenga tamaño 100 y sean las imagenes tmaño igual-->
    </div>
<?php } }
?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselImg" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselImg" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



        <img src="imagenes/productos/1/principal.jpg">
     </div>

     <div class="col-md-6 order-md-2">
        <h2>   
  <?php echo $nombre; ?> </h2>

        <?php
        if($descuento > 0){?>
          <p><del><?php echo MONEDA . number_format ($precio, 2, '.', ','); ?></del></p>
          <h2>
          <h2><?php echo MONEDA . number_format ($precio_desc, 2, '.', ','); ?></h2>
          <small class="text-success"><?php echo $descuento; ?> %descuento</small>
          </h2>
          <?php } else { ?>

        <h2><?php echo MONEDA . number_format ($precio, 2, '.', ','); ?></h2>
        <?php } ?>
        <p class="lead">
          <?php echo $descripcion; ?>
        </p>

          <div class = "d-grid gap-3 col-10 mx-auto">
            <button class="btn btn-primary" type="button">Comprar ahora</button>
            <button class="btn btn-outline-primary" type="button">Agregar al carrito</button>

          </div>
      </div>
    </div>
    </div>
    
  </main>


<?php include ("footer.php"); ?>
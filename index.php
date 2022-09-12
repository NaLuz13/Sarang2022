<?php 
include 'config.php';
include("database.php");
$id = "SELECT * FROM productos";
 include ("header.php");
 ?>

<main>
<div class="container">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"><!--el primer row es si es chico 1 col, 2 si es mas grande y 3 en total, el g es el espacio entre columnas-->
      <?php $resultado = mysqli_query($conexion, $id);
                      while ($row = mysqli_fetch_assoc($resultado)) { 
                        ?>
        <div class="col"><!--donde vemos las cosas-->
          <div class="card shadow-sm">
          <?php //NO TOCAR
                           $id = $row['id'];                
                           $imagen = "imagenes/productos/$id/principal.jpg";
                            if(!file_exists($imagen)){
                           $imagen = "imagenes/no-photo.jpg";//funciona
                          }
                      ?>
                <img src="<?php echo $imagen; ?>" class="d-block w-100"><!--NO TOCAR-->

            <div class="card-body"><!--cuerpo de la carta-->
                    <h5 class="card-title"><?PHP echo $row['nombre']; ?></h5>
                      <p class="card-text">$ <?PHP echo number_format($row['precio'], 2, '.', ','); ?></p>
                         <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                               <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?> " class="btn btn-primary">Detalles</a><!--le mandamos para que valla con el token y el id especifico-->
                           </div>
                              <a href="" class="btn btn-success align-items-border">Agregar</a>
                          </div>
               </div>
           </div>
          </div>
      <?php } ?>
</div>
</div>

</main>




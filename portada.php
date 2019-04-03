<!DOCTYPE html>

<?php
	
class Portada{

function createThumbnail($image_name, $new_width, $new_height, $uploadDir, $prefix = "thumb_"){

	    $path = $uploadDir . '/' . $image_name;
	    $mime = getimagesize($path);
	    if($mime['mime']=='image/png'){ $src_img = imagecreatefrompng($path); }
	    if($mime['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($path); }
	    if($mime['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($path); }
	    if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($path); }
	    $old_x          =   imageSX($src_img);
	    $old_y          =   imageSY($src_img);
	    if($old_x > $old_y) {
	        $thumb_w    =   $new_width;
	        $thumb_h    =   $old_y*($new_height/$old_x);
	    }
	    if($old_x < $old_y) {
	        $thumb_w    =   $old_x*($new_width/$old_y);
	        $thumb_h    =   $new_height;
	    }
	    if($old_x == $old_y) {
	        $thumb_w    =   $new_width;
	        $thumb_h    =   $new_height;
	    }
	    $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);
	    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	    // New save location
	    $new_thumb_loc = $uploadDir.$prefix.$image_name;
	    if($mime['mime']=='image/png'){ $result = imagepng($dst_img,$new_thumb_loc,8); }
	    if($mime['mime']=='image/jpg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
	    if($mime['mime']=='image/jpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
	    if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
	    imagedestroy($dst_img);
	    imagedestroy($src_img);
	    return $result;
	}

}

?>

 <?php

/*
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

       
        $sentencia = 'SELECT Fichero FROM fotos WHERE Album="9" LIMIT 1';
    
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }

        $ruta = mysqli_fetch_assoc($resultado);
        $nombre= explode('/', $ruta['Fichero']);

      echo "<img src=files/fotos/tinythumb_". $nombre[2] . " alt='Foto'/>";
      */

?>


</html>
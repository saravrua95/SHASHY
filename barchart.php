<?php

//VISUALIZAR EL GRAFICO

$mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

if($mysqli->connect_errno) {
echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
echo '</p>';
exit;
}

$response = $mysqli->query("SELECT count(*) as cuantos, DAYOFWEEK(Fregistro) as dia FROM fotos WHERE Fregistro > DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY DATE(Fregistro)");
			if(!$response){
				die($mysqli->error);
			}
			$values = array();
			$column_text = array();
			while($aux=$response->fetch_assoc()){
				$values[] = $aux["cuantos"];
				$column_text[] = $aux["dia"];
			}
			$newvalues = array();
			$newcolum_text = array();
			$dayofweek = $column_text[0];
			for($i=0; $i<7; $i++){
				switch($dayofweek){
					case 1:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Sat";
					break;
					
					case 2:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Mon";
					break;
					
					case 3:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Thu";
					break;
					
					case 4:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Wed";
					break;
					
					case 5:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Tur";
					break;
					
					case 6:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Fri";
					break;
					
					case 7:
						if (in_array($dayofweek, $column_text)){
							$newvalues[] = $values[array_search($dayofweek, $column_text)];
						} else $newvalues[] = 0;
						$newcolumn_text[] = "Sun";
					break;
				}
				$dayofweek++;
				if ($dayofweek > 7) $dayofweek=1;
			}
			
			header ("Content-type: image/png");
			generarGrafico($newvalues, $newcolumn_text);
			exit;


//FUNCION QUE GENERA EL GRAFICO

function generarGrafico($values, $column_text){

	$columns  = count($values);
	// Get the height and width of the final image
    $width = 300;
    $height = 200;
	// Set the amount of space between each column
    $padding = 5;
	$padding_bottom = 15;
	// Get the width of 1 column
    $column_width = $width / $columns ;
	// Generate the image variables
    $im        = imagecreate($width,$height);
    $gray      = imagecolorallocate ($im,0xd3, 0xd3, 0xd3);
    $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
    $fuchsia = imagecolorallocate ($im,0xff, 0x69, 0xb4);
    $white     = imagecolorallocate ($im,0xff,0xff,0xff);
	// Fill in the background of the image
    imagefilledrectangle($im,0,0,$width,$height,$white);
    $maxv = 0;
	// Calculate the maximum value we are going to plot
    for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);
	// Now plot each column
    for($i=0;$i<$columns;$i++) {
        $column_height = ($height / 100) * (( $values[$i] / $maxv) *100);
        $x1 = $i*$column_width;
        $y1 = $height-$column_height;
        $x2 = (($i+1)*$column_width)-$padding;
        $y2 = $height-$padding_bottom;
		imagestring($im, 5, $x2 - $column_width/2 - 10, $y2 - 1, "".$column_text[$i], $fuchsia);
		
		// This part is just for 3D effect
		if($values[$i]){
			imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);
			imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
			imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
			imageline($im,$x2,$y1,$x2,$y2,$fuchsia);
		}
		imagestring($im, 5, $x2 - $column_width/2 - 5, $y2 - 15 - 3, "".$values[$i], $fuchsia);
    }
    imagepng($im);
}

?>
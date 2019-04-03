<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">



<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>

<?php 
    if (isset($_POST['title'])) {
        $titulo =  $_POST['title'];
    }
    if (isset($_POST['fecha'])) {
        $fecha =  $_POST['fecha'];
    }
    if (isset($_POST['pais'])) {
        $pais =  $_POST['pais'];
    }
    if (isset($_POST['album'])) {
        $album =  $_POST['album'];
    }
    if (isset($_POST['descripcion'])) {
        $descripcion =  $_POST['descripcion'];
    }
    if (isset($_POST['formato'])) {
        $boolcolor =  $_POST['formato'];
    }
    if (isset($_POST['resu'])) {
        $resolucion =  $_POST['resu'];
    }
    if (isset($_POST['copies'])) {
        $copias =  $_POST['copies'];
    }
    if (isset($_POST['favcolor'])) {
        $color =  $_POST['favcolor'];
    }

    $direccion =  $_POST['calle'] .' '. $_POST['num'] .' '. $_POST['puerta'] .' '. $_POST['ciudad'] .' '. $_POST['pais'] .' '. $_POST['pc'];

    if (isset($_POST['aname'])) {
        $nombre =  $_POST['aname'];
    }


    if (isset($_POST['aname'])) {
        $nombre =  $_POST['aname'];
    }
    
        
    $fechareg = date("Y-m-d");

    $insertado = false;
        $sql = "INSERT INTO solicitudes (Album, Nombre, Titulo, Descripcion, Direccion, Color, Copias, Resolucion, Fecha, IColor, FRegistro)
            VALUES ('".$album."', '".$nombre."', '".$titulo."', '".$descripcion."', '".$direccion."',  '".$color."',  '".$copias."',  '".$resolucion."',  '".$fecha."',  '".$boolcolor."',  '".$fechareg."')";

    
        include 'utilidades.php';
        $insertado = Utilidades::ejecutaInsert($sql);   

    if($insertado==true){
        echo "
        <h3>Your requested album</h3>

        <p class='principales'>Your album was requested successfully! We hope it arrives soon :D</p><br>
        
         <section class='principales'>
     <table>
         <tr>
            <th>Name:</th>
            <td>". $_POST['aname'] . "</td>
            </tr>
            <tr>
             <th>Title:</th>
            <td>". $_POST['title']." </td>
             </tr>
             <tr>
            <th>Aditional text:</th>
            <td>". $_POST['descripcion'] . "</td>
            </tr>
            <tr>
            <th>Street:</th>
            <td>" . $_POST['calle'] . "</td>
            </tr>
             <tr>
            <th>Number:</th>
            <td>" . $_POST['num'] . "</td>
            </tr>
            <tr>
            <th>Door:</th>
            <td>" . $_POST['puerta']. "</td>
             </tr>
            <th>City:</th>
             <td>". $_POST['ciudad']. "</td>
            </tr>
            <tr>
            <th>Country:</th>
            <td>". $_POST['pais']."</td>
            </tr>
            <tr>
            <th>Post code:</th>
            <td>" . $_POST['pc'] . "</td>
            </tr>
            <tr>
            <th>Cover color:</th>
            <td>" .  $_POST['favcolor'] . "</td>
            <tr>
            <th>Number of copies:</th>
            <td>". $_POST['copies']."</td>
            </tr>
            <tr>
            <th>Image resolution:</th>
            <td>";
             if(isset($_POST['resu'])) {echo $_POST['resu'];} 
             echo "</td>
        </tr>


        </table>
<br><br>


        <section class='principales'><form action='principal.php'><button>Home</button></form></section>

        ";


    }
    else{
        echo "<p class='principales'>Ooops, something was wrong! Go back to try again.</p><br>
        <section class='principales'><form action='solicitaralbum.php'><button>Go back</button></form></section>
        ";
    }

?>



   
        
    
</body>

<br><br><br>

<?php include("footer.php"); ?>

</html>
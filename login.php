<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>
<?php include("header.php"); ?>

    <h2>Log in!</h2>
    <section class="principales">
<form method="POST" action="acceso.php">
    <label><b>User</b></label>
    <input type="text" placeholder="Username!" name="uname" required>
    <br><br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Password!" name="psw" required>
    <br><br>
    <label><b>Remember me!</b></label>
    <input method="post" class="altinput" type="checkbox" name="guardar" value="recuerdausu">   
    <br><br>
    <button type="submit">Come in!</button>
    
</form>
        </section>

    <?php
    
        if(isset($_GET['error'])){
            
            if($_GET['error']=="si"){
                echo "<p>Ooops, wrong user name or password. Try it again!</p>";
                $error="no";
            }
        }
    ?>
    
</body>

<br><br><br>
<?php include("footer.php"); ?>

</html>
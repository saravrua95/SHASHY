<?php
session_start();
?>
<!DOCTYPE html>

<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>
    
<h2>Delete your account</h2>
    
    <section class="principales">
    <p>Are you sure you wanna delete your account?</p>
    <form action='menuperfil.php'><button>Go back</button></form><br>
    <form action='borrarusr.php'><button>Delete account</button></form>

    </section>
    
</body>

<br><br><br>
    
<?php include("footer.php"); ?>

</html>
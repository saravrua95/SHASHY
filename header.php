
<header>
	<a class='titulo' href='principal.php'><h1 class="en-linea">Shashy  <img src="http://i.imgur.com/g5tefGi.png" alt="Logotipo de Sashy" width="125" height="100"></h1> </a>

		<section class="cabecera">
            
            <?php 
            if(isset($_SESSION['uname'])){
                
                if(isset($_COOKIE['nombre'])){   
                
                echo "<p class='en-linea'>Welcome, ". $_SESSION['uname'] . "! Your last visit was on: ". $_COOKIE['fecha_mostrar'] . "</p><br>
                <form class='en-linea' action='logout.php'><button type='submit'>Log out ):</button></form><br><br>";
                
                }
                       
                else{
                
                    echo "<p class='en-linea'>Welcome, ". $_SESSION['uname'] . "</p><br>
                <form class='en-linea' action='logout.php'><button type='submit'>Log out ):</button></form><br><br>";
                }
                
                       }
                   
            else{
                
                echo "<form class='en-linea' action='login.php'><button type='submit'>Log in!</button></form> <form class='en-linea' id='registro' action='registro.php'><button type='submit'>Register!</button></form><br><br>";
            }
                
            ?>
            
			<section class = "en-linea">
                <form method="post" action="busquedaetiquetas.php">
				<input type="search" name="googlesearch" placeholder="Search pics :D">
				<button  type="submit">Go!</button></form>
			</section>

		</section>


<hr class="separador">
    
    <?php if(isset($_SESSION['uname'])){
    
       echo "<a class = 'hvr-grow' href='principal.php'>Home   </a>  
            <a class = 'hvr-grow' href='formulariobusqueda.php'>Advanced Search   </a>  
            <a class = 'hvr-grow' href='help.php'>Help   </a>
            <a class = 'hvr-grow' href='menuperfil.php'>User menu   </a>
            <br><br><br>";
    }
    
    else{
        
        echo "<a class = 'hvr-grow' href='principal.php'>Home   </a>  
        <a class = 'hvr-grow' href='formulariobusqueda.php'>Advanced Search   </a>  
        <a class = 'hvr-grow' href='help.php'>Help   </a>
        <br><br><br>";
            
    }
    
    ?>
    
</header>

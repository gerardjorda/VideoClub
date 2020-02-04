<?php
    session_start();    //INICIO LA SESSIO.
    
    if(isset($_SESSION["user"]))        //SI HI HA LA SESSIO DE USUARI CREADA, JA ENTRA AL MENU.
    {
        header("location: menu.php");
    }                                   //SINO:
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>      
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">     
    <title>goblin.d&d</title>
    </head>
    
    <body>
    <h1>Welcome <?php echo $users ?></h1>
    <form action="validarlogin.php" method="post">      
        <table>
            <tr>
                <td><input type="text" name="user" placeholder="User name or email"></td>
            </tr>
            <tr>
                <td> <input type="text" name="password" placeholder="Password"></td>
            </tr>
        </table>
        <a href="norecordo.php">I forgot my password...</a> 
        <br>
        <br>
    <button id="mysubmit" type="submit" name="login">Login</button>
    <?php
        if(isset($_SESSION["error"]))           //SI HI HA LA SESSION ERROR EL TREC EN VERMELL PER PANTALLA.
        {
            echo '<br><div style="color:red; font-size=16px;">'.$_SESSION["error"].'</div>';
            session_destroy();
        }
        if(isset($_SESSION["result"]))          //SI EXISTEIX LA SESSION RESULT LA TREC EN VERD.
        {
            echo '<br><div style="color:green; font-size=16px;">'.$_SESSION["result"].'</div>';
        }
    ?>

    </form>
</body>
</html>


<?php

    session_start();
    
    if ( session_status() == PHP_SESSION_ACTIVE ) 
    {
        $_SESSION["ATIVADA"] = 1;
        $_SESSION["SID"] = session_id();
    }
    
    if ( true ) { $_SESSION["LOGIN"] = "alison"; }

    echo "<pre> Sessão:";
    print_r($_SESSION);
    echo "</pre>";

?>	
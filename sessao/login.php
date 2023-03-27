
<?php

    session_name("lojaRMS");
    session_start();

    $bd = connectBD()
    
    createSession( $bd, "", session_id() ) 

    mysqli_close($br);
?
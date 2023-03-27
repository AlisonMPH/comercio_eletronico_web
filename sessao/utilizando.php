
<?php

    session_name("lojaRMS");
    session_start();

    $bd = connectBD()
    
    updateSessionWorkingTime( $bd, session_id() ) 

    mysqli_close($br);
?
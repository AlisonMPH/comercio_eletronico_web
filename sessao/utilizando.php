<?php

    include "cockies.php";
    include "controle_sessao.php";

    session_name("MPH");
    session_start();

    $bd = connectBD();
    
    updateSessionWorkingTime( $bd, session_id() );

    mysqli_close($bd);

?>
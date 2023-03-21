
<?php

    $senha = $_POST["senha"];
    $senha_cripto = password_hash( $senha, PASSWORD_BCRYPT);
    
    
    $inserir->bind_param("sss", $login, $cpf, $senha_cripto );
    
    
    echo $senha_cripto."<br>";

    echo password_verify( $senha, $senha_cripto );
    
    echo "<hr><pre> Sessão:";
    print_r($_SERVER);
    echo "</pre>";
?>
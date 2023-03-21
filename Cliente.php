<?php

 include "doc_html.php";

 $servidor = "localhost"; // nome do servidor que possui
 // o MySQL Server na rede da empresa
 $admin = "myalisonmpda"; // login do usuário(a) do BD no CDMon
 $senha = "7EswBZI6"; // senha do usuário(a) do BD no CDMon
 $banco = "mpheletronicos"; // nome do banco de dados

 // A classe MySQLi cria um objeto que está conectado ao banco de dados (se os parâmetros)
 // estiverem corretos
 $BD = new mysqli($servidor, $admin, $senha, $banco);


    if ( $BD ) 
    {
        if (count($_POST) > 0 )
        {
        Insere_Dados($BD);
        }

        $formulario = Exibe_Formulario();
                
        echo Monta_Doc_HTML( $formulario . "<hr>");
        echo "<hr>POST: <br><pre>"; print_r($_POST); echo "</pre>";
    }
    else
    {
    //$msg_erro = $BD->connect_errno;
    echo "Conexão ao BD falhou: " . $msg_erro;
    }

function Exibe_Formulario()
{
$form = "";
$form .= "<form action='Cliente.php' method='post'>";

$form .= "Nome:<br> <input type='text' name='Nome'> <br>";
$form .= "Login:<br> <input type='text' name='Login'> <br>";
$form .= "Senha:<br> <input type='password' name='Senha'> <br>";

$form .= "<input type='submit' value='Enviar'>";
$form .= "<input type='reset' value='Cancelar'>";

$form .= "</form>";

return $form;
}

function Insere_Dados( $p_Conexao_BD )
 {
 //$XP = 1;
 $Nome = $_POST["Nome"];
 $Login = $_POST["Login"];
 $Senha = $_POST["Senha"];
 $senha_cripto = password_hash( $Senha, PASSWORD_BCRYPT);

 $sql = "INSERT INTO CLIENTE (NOME, LOGIN, SENHA) VALUES ( ?, ?, ? );";

 $comando = $p_Conexao_BD->prepare( $sql );
 $comando->bind_param("sss", $Nome, $Login, $senha_cripto);
 $comando->execute();
}
?>
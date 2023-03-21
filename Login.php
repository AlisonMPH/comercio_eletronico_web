
<?php

    include "verifica_senha.php";

    if ( count($_POST) == 0 )
    {
        echo Exibe_Form_Login();
    }
    else
    {
        Verifica_Login();
    }

    function Exibe_Form_Login()
    {
        $form = "";
        $form .= "<head><meta charset='utf-8'><title>MPH Eletronicos</title><link rel='stylesheet' href='style.css'></head>";        
        $form .= "<form action='Login.php' method='post'>";
        $form .= "Login: <input type='text' name='login'> <br>";
        $form .= "Senha: <input type='password' name='senha'> <br>";
        $form .= "<input type='submit' value='Enviar'>";
        $form .= "<input type='reset' value='Cancelar'>";
        
        return $form;
    }
    
    function Verifica_Login()
    {
        Verifica_Senha( $_POST["login"], $_POST["senha"] );
    }
?>
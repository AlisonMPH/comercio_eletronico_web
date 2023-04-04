
<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        //include_once "controle_sessao.php";
        //Sessao_Arquivo(basename(__FILE__));

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        //Sessao_Incluir_Arquivo( "controle_bd.php" );
        
        // Os próximos arquivos virão em ordem de "necessidade"
        include_once "doc_html.php";
        //Sessao_Incluir_Arquivo( "doc_html.php" );
        

    // #########################
    // 2º) Programa:

        if ( Cliente_Logado() )
        {
            $_SESSION["Nome"] = "Fulano";
            
            echo Monta_Doc_HTML( Cliente_BoasVindas( $_SESSION["Nome"] ) );
        }
        else
        {
            echo Monta_Doc_HTML( Cliente_Login() );
        }
        
    // #########################
    // 3º) Funções:

        function Cliente_XP( $p_Login="" )
        {
            return 1;
        }

        function Cliente_Logado()
        {
            return 0; //array_key_exists("XP_Cliente", $_SESSION);
        }

        function Cliente_Login()
        {
            $form = "";
            $form .= "<form action='cliente.php' method='post'>";
            $form .= "Login: <input type='text'> <br>";
            $form .= "Senha: <input type='password'> <br>";
            $form .= "<input type='submit' value='Enviar'><input type='reset' value='Cancelar'>";
            $form .= "</form>";

            return $form;
        }    

        function Cliente_BoasVindas( $p_Nome="" )
        {
            $boas = "";

            $boas .= "Bem vindo ".$p_Nome." você pode utilizar o site para....";

            return $boas;
        }

?>

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
        
        //include_once "cliente.php";
        //Sessao_Incluir_Arquivo( "cliente.php" );

    // ##################
    // 2º) Programa:

        // Cliente faz login >> SE FOR NECESSÁRIO <<, e retorna a Xave Primária:
        //$login = Cliente_XP();

        echo Monta_Doc_HTML("Parabéns .$ login., você tem paciência para usar o CDMon...");


    // #########################
    // 3º) Funções:
    /*
        function Verifica_Login()
        {
            $usuario = $_POST["usuario"];
            $senha = $_POST["senha"];
            
            $_POST["login"] = NULL;
            if ($usuario=="ricardo") && ($senha=="123")
            {
                $_POST["login"] = $usuario;
            }
        }
        */
        /*
        function Form_Login()
        {
            $form = "";
            $form .= "<form action='login.php' method='post'>";
            $form .= "<input type='hidden' name='origem' value='login.php'>";
            $form .= "Login: <input type='text' name='usuario'> <br>";
            $form .= "Senha: <input type='password' name='senha'> <br>";
            $form .= "<input type='submit' value='Entrar'> <input type='reset' value='Cancelar'>";
            $form .= "</form>";
            
            return $form;
        }
*/
?
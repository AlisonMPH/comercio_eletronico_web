
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

        //Sessao_Utilizando( $login );

        echo Monta_Doc_HTML("Parabéns, você tem paciência para usar o CDMon...");

?
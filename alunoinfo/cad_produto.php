<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        $f = "Sessao_Arquivo"; $a = basename(__FILE__); if ( ! function_exists($f) ) { die("XX - '".$a."' não possui: '".$f."()' !?"); } $f($a); 

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        Sessao_Incluir_Arquivo( "controle_bd.php" );
        
        // Os próximos arquivos virão em ordem de "necessidade"
        //include_once "doc_html.php";
        Sessao_Incluir_Arquivo( "doc_html.php" );
        
        Sessao_Incluir_Arquivo( "bd_produto.php" );

    // ##################
    // 2º) Programa:

        // Cliente faz login >> SE FOR NECESSÁRIO <<, e retorna a Xave Primária:
        //$login = Cliente_XP();

        $conteudo = "Página de cadastro de produtos";

        $conteudo .= Exibe_Formulario();
        
        echo Monta_Doc_HTML( basename(__FILE__), $conteudo );


    // #########################
    // 3º) Funções:

?>
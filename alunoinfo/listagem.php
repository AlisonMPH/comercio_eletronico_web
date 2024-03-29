<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        
        // registra o arquivo atual
        $funcao = "";
        $funcao = "Sessao_Arquivo"; if ( ! function_exists($funcao) ) { die("XX - A função: ".$funcao." não existe !?"); } $funcao(basename(__FILE__)); 

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        Sessao_Incluir_Arquivo( "controle_bd.php" );
        
        // Os próximos arquivos virão em ordem de "necessidade"
        //include_once "doc_html.php";
        Sessao_Incluir_Arquivo( "doc_html.php" );
        
        include_once "bd_produto.php";
        
        //include_once "cliente.php";
  
    // ##################
    // 2º) Programa:

        $BD = BD_Conectar();
        
        $listagem = "";
        $listagem = Consulta_Dados( $BD );
        
        echo Monta_Doc_HTML( basename(__FILE__), $listagem );

?>
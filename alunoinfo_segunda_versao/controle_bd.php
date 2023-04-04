
<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        Sessao_Arquivo(basename(__FILE__));

        // por enquanto não precisa de outros arquivos...

    // #########################
    // 2º) Programa:

        // ************************************************************************************
        function BD_Conectar()
        {
            $servidor = "localhost";
            $usuario = "alisonmozer";
            $senha = "abcd1234";
            $banco_de_dados = "amsifes";

            $conexao = new mysqli($servidor, $usuario, $senha, $banco_de_dados);

            return $conexao;
        }

        // ************************************************************************************
        function BD_Desconectar( $p_Conexao )
        {
            $p_Conexao->close();
            return true;
        }

?>
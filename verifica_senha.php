
<?php

    function Verifica_Senha( $p_Login, $p_Senha )
    {    
    // 1º -------------------------------------------------------------------------
        // Para conectar ao Banco de Dados, os parâmetros são:
        $servidor = "localhost";     // nome do servidor que possui 
            						 // o MySQL Server na rede da empresa
        $admin = "myalisonmpda";	         // login do usuário(a) do BD no CDMon
        $senha = "7EswBZI6";		 // senha do usuário(a) do BD no CDMon
        $banco = "mpheletronicos";			 // nome do banco de dados
        
        $BD = new mysqli( $servidor, $admin, $senha, $banco );
        if( $BD )
        {
            $senha_bd = Consulta_Cliente( $BD, $p_Login );
            return Compara_Senha( $senha_bd, $p_Senha );
        }
        else
        {
            echo "Erro no BD!";
        }

    }
    
    function Consulta_Cliente( $p_Conexao, $p_Login )
    {
        $sql = "SELECT * FROM CLIENTE WHERE LOGIN = '?';";
        
        $comando = $p_Conexao->prepare($sql);
        $comando->bind_param("s", $p_Login);
        $comando->execute();

        $registro = $comando->get_result();
        $usuario = $registro->fetch_assoc();

        return $usuario["SENHA"];
    }
    
    function Compara_Senha( $p_Senha_BD, $p_Senha_Form )
    {
        return password_verify( $p_Senha_BD, $p_Senha_Form);
    }
?>
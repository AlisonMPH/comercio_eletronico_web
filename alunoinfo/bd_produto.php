<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        
        // registra o arquivo atual
        $funcao = "Sessao_Arquivo"; if ( ! function_exists($funcao) ) { die("XX - A função: ".$funcao." não existe !?"); } $funcao(basename(__FILE__)); 

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        Sessao_Incluir_Arquivo( "controle_bd.php" );
        
    // ##################
    // 2º) Programa:

    // Monta o formulário de Cadastro:
    function Exibe_Formulario()
    {
        $form = "";
        $form .= "<form action='bd_produto.php' method='post'>";

        $form .= "Nome: <input type='text' name='Nome'> <br>";
        $form .= "Descrição: <textarea name='Descricao' rows='5' cols='40'> </textarea><br>";
        $form .= "Preço: <input type='text' name='Preco'> <br>";

        $form .= "<input type='submit' value='Enviar'>";
        $form .= "<input type='reset' value='Cancelar'>";

        $form .= "</form>";
        
        return $form;
    }


    // Faz a consulta, e monta uma listagem:
    function Consulta_Dados( $p_Conexao_BD )
    {
        $listagem = "";
        $sql =  "select * from Produto;";
        $REGISTROS = $p_Conexao_BD->query($sql);
    	
        $listagem .= "<hr>Listagem dos dados<hr>";
        while( $registro = $REGISTROS->fetch_assoc() ) 
        {
			$listagem .= "XP: " . $registro["XP_Produto"]. 
                         " - Nome: " . $registro["P_Nome"]. 
                         " - Descrição: " . $registro["P_Descricao"]. 
                         " - Preço " . $registro["P_Preco"]. "<br>";
        }
        
        $listagem .= "<hr>Fim dos dados<hr>";
        
        return $listagem;
    }
	
    // Insere os dados na tabela
    function Insere_Dados( $p_Conexao_BD )
    {
        //$XP = 2;
        $Nome = $_POST["Nome"];
        $Codigo = $_POST["Codigo"];
        $Descricao = $_POST["Descricao"];
        $Preco = $_POST["Preco"];
        $sql = "insert into Produto (P_Nome, P_Preco ) values ( ?, ? );";

        $p_Conexao_BD->prepare( $sql );
		// O método "prepare()" literalmente prepara o comando INSERT para receber parâmetros
		// os sinais "?" representam os valores (que estão nas variáveis) e serão inseridos
        
        echo "bind()<br>";
	    //$comando->bind_param("sd", $Nome, $Preco);
		// O método "bind_param()" faz a "transferência" dos valores nas variáveis para o
		// comando que será executado.
		// O primeiro parâmetro representa os tipos dos valores nas variáveis:
		// "i": números inteiros e booleans
		// "s": string
		// "d": double, float e decimal(n,m)
        
        echo "execute()<br>";
	    //$comando->execute(); // executa o comando, com as variáveis transferidas

    }
	
?>	
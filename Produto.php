<?php

    $servidor = "localhost";

    $admin = "myalisonmpda";
    $senha = "7EswBZI6";
    $banco = "mpheletronicos";

    $BD = new mysqli($servidor, $admin, $senha, $banco);

    if ($BD)
    {
        Insere_Dados($BD);
        Consulta_Dados($BD);
    }
    else
    {
        $msg_erro = $BD->connect_errno;
        echo "Conexão ao BD falhou: " . $msg_erro;
    }
    $BD->close();

    function Consulta_Dados ($p_Conexao_BD)
    {
        $sql = "SELECT * FROM PRODUTO;";
        $REGISTROS = $p_Conexao_BD-> query($sql);

        while($registro = $REGISTROS->fetch_assoc())
        {
            echo "ID: ".$registro["ID"]."- Nome: ".$registro["NOME"]." - Preço: ".$registro["PRECO"]." - Quatidade: ".$registro["QUANTIDADE"]." - Categoria: ".$registro["CATEGORIA"]."<br>";
        }

        echo"<br>Fim dos dados<hr>";
    }
    function Insere_Dados ($p_Conexao_BD)
    {

    }

?>
<?php
        function Consulta_Dados ($p_Conexao_BD)
    {
        $listagem = "";
        $sql = "SELECT * FROM Produto;";
        $REGISTROS = $p_Conexao_BD-> query($sql);
        $listagem .= "<hr>Listagem dos dados<hr>";
        while($registro = $REGISTROS->fetch_assoc())
        {
            $listagem .= "ID: ".$registro["XP_Produto"]."- Nome: ".$registro["P_Nome"]."- Preço: ".$registro["P_Preco"]."- Descrição: ".$registro["P_Descricao"]."<br>";
        }
        $listagem .= "<hr>Fim dos dados<hr>";
        return $listagem;
    }
?>
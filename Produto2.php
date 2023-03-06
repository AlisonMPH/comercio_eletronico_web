<?php
    include 'doc_html.php';

    $servidor = "localhost";

    $admin = "myalisonmpda";
    $senha = "7EswBZI6";
    $banco = "mpheletronicos";

    $BD = new mysqli($servidor, $admin, $senha, $banco);

    if ($BD)
    {
        if ( count($_POST) > 0 )
        {
        Insere_Dados($BD);
        }
            $formulario = Exibe_Formulario();
            $consulta = Consulta_Dados($BD);
            echo Monta_Doc_HTML( $formulario . "<hr>" . $consulta );
            echo "<hr>POST: <br><pre>"; print_r($_POST); echo "</pre>";
        }
    else
    {
        $msg_erro = $BD->connect_errno;
        echo "Conexão ao BD falhou: " . $msg_erro;
    }
    $BD->close();

    function Consulta_Dados ($p_Conexao_BD)
    {
        $listagem = "";
        $sql = "SELECT * FROM PRODUTO;";
        $REGISTROS = $p_Conexao_BD-> query($sql);

        $listagem .= "<hr>Listagem dos dados<hr>";
        while($registro = $REGISTROS->fetch_assoc())
        {
            $listagem .= "ID: ".$registro["ID"]."- Nome: ".$registro["NOME"]." - Preço: ".$registro["PRECO"]." - Quatidade: ".$registro["QUANTIDADE"]." - Categoria: ".$registro["CATEGORIA"]."<br>";
        }
        $listagem .= "<hr>Fim dos dados<hr>";
        return $listagem;
    }
    function Insere_Dados ($p_Conexao_BD)
    {
        $NOME = '';
        $PRECO = '';
        $QUANTIDADE = '';
        $FABRICANTE = '';
        $MODELO = '';
        $CATEGORIA = '';
        
        $sql = "INSER INTO PRODUTO (NOME,PRECO,QUANTIDADE,FABRICANTE,MODELO,CATEGORIA) VALUES (?,?,?,?,?,?);";
        
        $comando = $p_Conexao_BD->prepare($sql);
        $comando->bind_param("sdisss", $NOME, $PRECO, $QUANTIDADE, $FABRICANTE, $MODELO, $CATEGORIA);
        $comando->execute();
    }

    function Exibe_Formulario()
    {
        $form = "";
        $form .= "<form action='Produto2.php' method='post'>";

        $form .= "Nome: <input type='text' name='Nome'> <br>";
        $form .= "Preço: <input type='text' name='Preco'> <br>";
        $form .= "Quantidade: <textarea name='Quantidade' rows='5' cols='40'> </textarea><br>";
        $form .= "Fabricante: <input type='text' name='Fabricante'> <br>";
        $form .= "Modelo: <input type='text' name='Modelo'> <br>";
        $form .= "Categoria: <select>
            <option>Placa de Video</option>
            <option>Notebook</option>
            <option>Rede</option>
            <option>Armazenamento</option>
            <option>Tela</option>
            <option>Som</option>
            <option>Smartphone</option>
            </select> <br>";

        $form .= "<input type='submit' value='Enviar'>";
        $form .= "<input type='reset' value='Cancelar'>";
        $form .= "</form>";

        return $form;
    }

?>
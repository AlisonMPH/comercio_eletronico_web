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
        $NOME = $_POST["NOME"];
        $PRECO = $_POST["PRECO"];
        $QUANTIDADE = $_POST["QUANTIDADE"];
        $FABRICANTE = $_POST["FABRICANTE"];
        $MODELO = $_POST["MODELO"];
        $CATEGORIA = $_POST["CATEGORIA"];
        $sql = "INSERT INTO PRODUTO (NOME,PRECO,QUANTIDADE,FABRICANTE,MODELO,CATEGORIA) VALUES (?,?,?,?,?,?);";
        
        echo "prepare()<br>";
        try {
            if ($p_Conexao_BD && method_exists($p_Conexao_BD,"prepare"))
            {$comando = $p_Conexao_BD->prepare($sql);}
        }
        catch(exception $e) {print_r($e); die();
        }
        
        $comando = $p_Conexao_BD->prepare($sql);
        $comando->bind_param("sdisss", $NOME, $PRECO, $QUANTIDADE, $FABRICANTE, $MODELO, $CATEGORIA);
        $comando->execute();
    }

    function Exibe_Formulario()
    {
        echo"<center>
        <a href='Cad_Produto.html'> <img src='img\produtos.png' width=50 height=30> </a>
        <a href='Loja.html'> <img src='img\loja.png' width=50 height=30></a>
        <a href='Carrinho.html'> <img src='img\carrinho.png' width=50 height=30> </a>
        <a href='Cliente.html'> <img src='img\cliente.png' width=50 height=30> </a>
        <a href='Produto2.php'> Cadastrar Produtos </a>
        </center><br>";

        $form = "";
        $form .= "<form action='Produto2.php' method='post'>";

        $form .= "Nome: <input type='text' name='NOME'> <br>";
        $form .= "Preço: <input type='text' name='PRECO'> <br>";
        $form .= "Quantidade: <input type='text' name='QUANTIDADE'> <br>";
        $form .= "Fabricante: <input type='text' name='FABRICANTE'> <br>";
        $form .= "Modelo: <input type='text' name='MODELO'> <br>";
        $form .= "CATEGORIA: <select>
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
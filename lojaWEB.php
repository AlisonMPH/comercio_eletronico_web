<?php
    
    class Loja
    {
        var $Nome = ""; //a palavra "var" é colocada para definir cada atributo de uma classe, PHP nao existe declaração do tipo das variaveis
        var $Lista_Produtos = []; //para definir "array" em PHP so precisa atribui o simbolo [] um array é uma lista de valores 
        var $Lista_Clientes = [];

        function Inserir_Produto( $produto ) //METODOS
        {
            $this->Lista_Produtos[] = $produto; //"this" é um objeto especial, para acessar os atributos e métodos da propria classe

        }
    }
    $filial = new Loja();
    $filial->Inserir_Produto("PRODUTO");

    echo    "<!doctype html>";
    echo    "<html>";
    echo    "<head> <meta charset='utf-8'> <title> MPH </title></head>";
    echo    "<body>";

    echo    "<form action='lojaWEB.php'>"; //No formulario temos que colocar a acao indicando qual arquivo fara o processamento dos dados. preferencialmente o mesmo arquivo que mostra o formulario
    echo    "Nome: <input id='id_Nome' name='nm_Nome' type='text'> <br>"; // Os campos input devem ter a propriedade name definindo os campos do formulario. Esses valores serao enviados para o servidor, na variavel $_GET
    echo    "Preço: <input id='id_Preco' name='nm_Preco' type='text'> <br>";
    echo    "Fabricante: <input id='id_Fabricante' name='nm_Fabricante' type='text'> <br>";
    echo    "Processador: <input id='id_Processador' name='nm_Processador' type='text'> <br>";
    echo    "Memoria: <input id='id_Memoria' name='nm_Memoria' type='text'> <br>";
    echo    "Ram: <input id='id_Ram' name='nm_Ram' type='text'> <br>";


    echo    "<input type='submit'>";
    echo    "</form>";
    
    echo    "<hr>";
    
    print_r($_GET); echo    "<br>";
    echo    "Nome: ".$_GET["nm_Nome"]."<br>";
    echo    "Preço: ".$_GET["nm_Preco"]."<br>";
    echo    "Fabricante: ".$_GET["nm_Fabricante"]."<br>";
    echo    "Processador: ".$_GET["nm_Processador"]."<br>";
    echo    "Memoria: ".$_GET["nm_Memoria"]."<br>";
    echo    "Ram: ".$_GET["nm_Ram"]."<br>";


    echo    "<hr>";
    
    $quant = count($filial->Lista_Produtos);
    for ($i = 0; $i < $quant; $i++)
    {
        echo    $filial->Lista_Produtos[$i] . "<br>";
    }

    echo    "</body>";
    echo    "</html>";
    
?>
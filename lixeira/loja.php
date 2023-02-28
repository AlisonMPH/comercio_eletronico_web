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

    echo    "<form>";
    echo    "Nome: <input type='text'> <br>";
    echo    " <input type='submit'>";
    echo    "</form>";
    echo    "<hr>";

    $quant = count($filial->Lista_Produtos);
    for ($i = 0; $i < $quant; $i++)
    {
        echo    $filial->Lista_Produtos[$i] . "<br>";
    }

    echo    "</body>";
    echo    "</html>";
    
?>
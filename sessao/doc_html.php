
<?php

    include "cookies.php";
    include "controle_sessao.php";

    function Monta_Doc_HTML( $p_Conteudo )
    {
        $html = "";

        $html .= "<!doctype html> <html>";

        $html .= "<head><meta charset='utf-8'><meta http-equiv='refresh' content='5'><title>Loja de Carros F1</title></head>";

        $html .= "<body>";

        $html .= $p_Conteudo;
        
        $html .= "<hr>".getSessionTable()."<hr>";
        
        $html .= "<hr>".getSession()."<hr>";
        
        $html .= "<script>".Cookies()."</script>";
        
        $html .= "</body>";

        $html .= "</html>";
    
        return $html;
    }

?>
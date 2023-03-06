<?php

 //////////////////////////////////////
 // SALVAR COMO: doc_html.php
 //////////////////////////////////////

 function Monta_Doc_HTML( $p_Conteudo )
 {
 $html = "";
 $html .= "<!doctype html> <html>";
 $html .= "<head><meta charset='utf-8'><title>MPH Eletronicos</title></head>";
 $html .= "<body>" . $p_Conteudo . "</body>";
 $html .= "</html>";

 return $html;
 }

 ?>
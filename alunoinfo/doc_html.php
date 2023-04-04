<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        
        // registra o arquivo atual
        $f = "Sessao_Arquivo"; $a = basename(__FILE__); if ( ! function_exists($f) ) { die("XX - '".$a."' não possui: '".$f."()' !?"); } $f($a); 

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //Sessao_Incluir_Arquivo( "controle_bd.php" );


    // #########################
    // 2º) Programa:
        function Monta_Doc_HTML( $Origem, $p_Conteudo )
        {
            $html = "";
            $html .= "<!doctype html> <html>";
            $html .= "<head>";
            $html .= "<meta charset='utf-8'><title>Loja de Carros F1</title>";
            $html .= "<style>";
            $html .= ".conteudo { vertical-align: top; padding: 5px; margin: 5px; border: 3px ridge gray; } ";
            $html .= ".esq { display: none; width: 500px; } .dir { width: 1300px; } ";
            $html .= ".menu { display: inline-block; width: 130px; height: 30px; ";
            $html .= "        border-radius: 5px; text-align: center; vertical-align: middle; text-decoration: none; line-height: 30px; margin: 5px; } ";
            $html .= ".amarelo  { background-color: yellow;  } ";
            $html .= ".laranja  { background-color: orange;  } ";
            $html .= ".vermelho { background-color: red;  } ";
            $html .= ".verde    { background-color: limegreen;  } ";
            $html .= ".roxo    { background-color: purple; color: white; } ";
            $html .= "</style>";
            $html .= "</head>";
            $html .= "<body><center>";
            
            $html .= "<table><tr>";
            $html .= "<td class='conteudo esq' id='controle'>";
            $html .= "<hr>".Sessao_SESSION()."<hr>";
            //$html .= "<script>".Cookies()."</script>";
            $html .= "<hr>".Sessao_Historico()."<hr>";
            $html .= "<hr>get_included_files(): <br><pre>";
            $html .= print_r(get_included_files(),true)."</pre><hr>";
            
            //$html .= "<hr>GLOBALS: <br><pre>";
            //$html .= print_r($GLOBALS,true)."</pre><hr>";
            
            $html .= "</td>";
            
            $html .= "<td class='conteudo dir'>";
            $html .= Menu($Origem);
            $html .= Javascript();
            $html .= $p_Conteudo;
            $html .= "</td>";
            
            $html .= "</tr></table>";
            
            $html .= "</center></body>";
            $html .= "</html>";
            
            return $html;
        }

        function Menu( $p_Origem="" )
        {
            $Menu_Principal = [ "Loja"=>"listagem.php", "Cadastro Produto" => "cad_produto.php", "Criar Conta"=>"cad_cliente.php", "Login"=>"login.php", "Sair"=>"logout.php" ];
            
            $menu = "<br><br><center>";
            $menu .= "<span class='menu roxo' onclick='Mostrar()'><<<</span>";
            $menu .= "<a class='menu laranja' href='#'>V1008</a>";
            foreach( $Menu_Principal as $link=>$arquivo )
            {
                $cor = ( $p_Origem=="" ? 'vermelho' : ($p_Origem==$arquivo ? "verde" : "amarelo") );
                $menu .= "<a class='menu ".$cor."' href='".$arquivo."'>".$link."</a>";
            }
            $menu .= "</center><br><br>";
            
            return $menu;            
        }
        
        function Javascript()
        {
            $js = "";
            $js .= "<script>";
            $js .= "function Mostrar() { var controle=document.getElementById('controle'); controle.style.display = ( controle.style.display=='block' ? 'none' : 'block' ); }";
            $js .= "</script>"; 
            
            return $js;
            
        }
        
        /*function Versao()
        {
            return (strval(int(date("H"))-5) . date("i"));
        }*/

?>
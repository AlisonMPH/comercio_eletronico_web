
<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        //include_once "controle_sessao.php";
        //Sessao_Arquivo(basename(__FILE__));

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        //Sessao_Incluir_Arquivo( "controle_bd.php" );
        
        // Os próximos arquivos virão em ordem de "necessidade"
        include_once "doc_html.php";
        //Sessao_Incluir_Arquivo( "doc_html.php" );
        

    // #########################
    // 2º) Programa:
        function Monta_Doc_HTML( $p_Conteudo )
        {
            $html = "";
            $html .= "<!doctype html> <html>";
            $html .= "<head>";
            $html .= "<meta charset='utf-8'><title>Loja de Carros F1</title>";
            $html .= "<style>";
            $html .= ".conteudo { vertical-align: top; padding: 5px; margin: 5px; border: 3px ridge gray; } ";
            $html .= ".esq { width: 620px; } .dir { width: 1200px; } ";
            $html .= ".menu { display: inline-block; background-color: yellow; width: 150px; height: 30px; ";
            $html .= "        border-radius: 5px; text-align: center; vertical-align: middle; text-decoration: none; line-height: 30px; margin: 5px; } ";
            $html .= "</style>";
            $html .= "</head>";
            $html .= "<body><center>";
            
            $html .= "<table><tr>";
            
            $html .= "<td class='conteudo esq'>".__FILE__."<hr><hr>";
            //$html .= print_r(get_included_files(),true)."<hr>";
            //$html .= "<hr>".Sessao_SESSION()."<hr>";
            //$html .= "<script>".Cookies()."</script>";
            //$html .= "<hr>".Sessao_Historico()."<hr>";
            $html .= "</td>";
            
            $html .= "<td class='conteudo dir'>";
            $html .= Menu();
            $html .= $p_Conteudo;
            $html .= "</td>";
            
            $html .= "</tr></table>";
            
            $html .= "</center></body>";
            $html .= "</html>";
        
            return $html;
        }

        function Menu()
        {
            $Menu_Principal = [ "Loja"=>"listagem.php", "Cadastro Produto" => "cad_prod.php", "Criar Conta"=>"cad_cliente.php", "Login"=>"login.php", "Sair"=>"logout.php" ];
            
            $menu = "<br><br><center>";
            foreach( $Menu_Principal as $link=>$arquivo )
            {
                $menu .= "<a class='menu' href='".$arquivo."'>".$link."</a>";
            }
            $menu .= "</center><br><br>";
            
            return $menu;            
        }

?
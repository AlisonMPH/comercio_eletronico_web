
<?php
    // #########################
    // 1º) Arquivos externos:
        // include: o arquivo é lido e processado toda vez que for incluído
        // include_once: o arquivo será lido e processador apenas na primeira vez que for incluído
        
        // O primeiro arquivo incluído será SEMPRE o controle de Sessão:
        include_once "controle_sessao.php";
        Sessao_Arquivo(basename(__FILE__));

        // O segundo arquivo incluído será SEMPRE o controle do Banco de Dados:
        //include_once "controle_bd.php";
        
        // Os próximos arquivos virão em ordem de "necessidade"

    // ##################
    // 2º) Funções:

    function Cookies()
    {
        $selecionar = "function getCookie(cname) {
                          let name = cname + '=';
                          let decodedCookie = decodeURIComponent(document.cookie);
                          let ca = decodedCookie.split(';');
                          for(let i = 0; i <ca.length; i++) {
                            let c = ca[i];
                            while (c.charAt(0) == ' ') {
                              c = c.substring(1);
                            }
                            if (c.indexOf(name) == 0) {
                              return c.substring(name.length, c.length);
                            }
                          }
                          return '';
                        } ";
        
        $listar = "function listCookies() {
                        var theCookies = document.cookie.split(';');
                        var aString = '<hr>';
                        for (var i = 1 ; i <= theCookies.length; i++) {
                            aString += i + ' ' + theCookies[i-1] + '<br>';
                        }
                        document.write(aString);
                    } listCookies(); ";
                    
        return $selecionar.$listar;

    }

    // ************************************************************************************
    function Cookie_Definir( $p_Chave, $p_Valor )
    {
        setcookie($p_Chave, $p_Valor, 0, __FILE__, session_name());
    }
    Cookie_Definir("Biscoito", "Água-e-Sal");

?
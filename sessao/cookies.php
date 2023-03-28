
<?php

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

setcookie("funcao", "Cookies");

?>
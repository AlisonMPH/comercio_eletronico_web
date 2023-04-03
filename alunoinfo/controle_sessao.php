
<?php
    // O primeiro passo é definir e iniciar a Sessão, para ter o controle do funcionamento da aplicação    
    // #########################
    // 1º) Programa:
        session_name("RMS-Ifes");
        session_start();
        
    // #########################
    // 2º) Arquivos externos:
        // Como este arquivo é o controle da Sessão, o "2º arquivo do projeto" é o "1º arquivo":
        include_once "controle_bd.php";
        //Sessao_Incluir_Arquivo( "controle_bd.php" );
        //include_once "login.php";
        //Sessao_Incluir_Arquivo( "login.php" );

    // #########################
    // 3º) Funções:
    
        // por segurança "força" a verificação do login:
        $verifica_login = true;
/*        
        // verifica se estava na tela de login:
        if ( count($_POST) > 0 )
        {
            if ( array_key_exists( "origem", $_POST ) )
            {
                if ( isset($_POST["origem"]) )
                {
                    if ( $_POST["origem"] == "login.php" )
                    {
                        Verifica_Login();
                    }
                }
            }
        }
        
        if ( $verifica_login )
        {
            // Verifica se o vetor $_SESSION possui um "login" registrado
            if ( ! array_key_exists( "login", $_SESSION ) )
            {
                Form_Login();
            }
            
            // Verifica se o "login" possui um valor, no LOGOUT o "login" é 'anulado'
            if ( ! isset($_SESSION["login"]) )
            {
                Form_Login();
            }
        }
*/        
    
        function Sessao_Arquivo( $p_Nome_Arquivo )
        {
            $_SESSION[$p_Nome_Arquivo] = ( array_key_exists($p_Nome_Arquivo, $_SESSION) ? ($_SESSION[$p_Nome_Arquivo]+1) : 1 );
        }
        
        Sessao_Arquivo(basename(__FILE__));
        
        // ************************************************************************************
        function Sessao_Incluir_Arquivo( $p_Arquivo )
        {
            //$TODOS = get_included_files();
            //if ( ! in_array( $p_Arquivo, $TODOS ) )
            {
            //    include_once $p_Arquivo;
            }
        }

        // ************************************************************************************
        function Sessao_SID()
        {
            return session_id();
        }

        // ************************************************************************************
        function Sessao_Login_Inserir( $p_XP_Cliente ) 
        {
            $sql = "INSERT INTO Sessao ( XE_Cliente, S_Login, S_SID) VALUES ( ?, ?, ? );";
            $data_hora_Atual = date('Y-m-d H:i:s');
            $sid = Sessao_SID();
            
            $conexao_bd = BD_Conectar();
            $comando = $conexao_bd->prepare( $sql);
            $comando->bind_param("iss", $p_XP_Cliente, $data_hora_Atual, $sid );
            $comando->execute();
            $comando->close();
            BD_Desconectar( $conexao_bd );
        }

        // ************************************************************************************
        function Sessao_Utilizando( $p_XP_Cliente ) 
        {
            $sql = "INSERT INTO Sessao ( XE_Cliente, S_Utilizando, S_SID ) VALUES ( ?, ?, ? );";
            $data_hora_Atual = date('Y-m-d H:i:s');
            $sid = Sessao_SID();
            
            $conexao_bd = BD_Conectar();
            $comando = $conexao_bd->prepare( $sql);
            $comando->bind_param("iss", $p_XP_Cliente, $data_hora_Atual, $sid );
            $comando->execute();
            $comando->close();
            BD_Desconectar( $conexao_bd );
        }

        // ************************************************************************************
        function Sessao_Logout( $p_XP_Cliente ) 
        {
            $sql = "INSERT INTO Sessao ( XE_Cliente, S_Logout, S_SID ) VALUES ( ?, ?, ? );";
            $data_hora_Atual = date('Y-m-d H:i:s');
            $sid = Sessao_SID();
            
            $conexao_bd = BD_Conectar();
            $comando = $conexao_bd->prepare( $sql);
            $comando->bind_param("iss", $p_XP_Cliente, $data_hora_Atual, $sid );
            $comando->execute();
            $comando->close();
            BD_Desconectar( $conexao_bd );
        }

        // ************************************************************************************
        function Sessao_Cliente_conectado( $p_SID ) 
        {
            $sql  = "SELECT XE_Cliente FROM Sessao ";
            $sql .= "WHERE ( S_SID = ? ) AND ( S_Expirou IS NULL ) AND ( s_Logout IS NULL ) AND ";
            $sql .= "      ( TIMESTAMPDIFF(SECOND, S_Utilizando, NOW()) < 600 );";
            
            $conexao_bd = BD_Conectar();
            $comando = $conexao_bd->prepare( $sql);
            $comando->bind_param("s", $p_SID );  // passa o parâmetro para o comando
            $comando->execute();
            $comando->bind_result( $XP_Cliente ); // para o resultado do comando para a variável
            $comando->fetch();
            $comando->close();
            BD_Desconectar( $conexao_bd );
            
            if ( $XP_Cliente) 
            {
                updateSessionWorkingTime( $p_SID );
            }
            
            return $XP_Cliente;
        }

        // ************************************************************************************
        function Sessao_Historico( )
        {
            // Query the sessions table
            $sql = "SELECT * FROM Sessao ORDER BY XP_Sessao DESC limit 10;";

            $conexao_bd = BD_Conectar();
            $result = $conexao_bd->query( $sql);
        
            // Build HTML table
            $historico = "<table>";
            $historico .= "<thead><tr style='background-color: lightblue;'><th>XP</th><th>Login</th><th>Utilizando</th><th>Logout</th><th>Expirou</th><th>SID</th><th>XE_Cliente</th></tr></thead>";
            $historico .= "<tbody>";
        
            // Loop through results and add to table
            $registro_cont = 0;
            while ( $registro = mysqli_fetch_assoc( $result)) 
            {
                $registro_cont++;
                if ( $registro_cont % 2 == 0) 
                {
                    $historico .= "<tr style='background-color: lightgreen;'>";
                } else 
                {
                    $historico .= "<tr style='background-color: lightred;'>";
                }
                $historico .= "<td>" . $registro['XP_Sessao'] . "</td>";
                $historico .= "<td>" . $registro['S_Login'] . "</td>";
                $historico .= "<td>" . $registro['S_Utilizando'] . "</td>";
                $historico .= "<td>" . $registro['s_Logout'] . "</td>";
                $historico .= "<td>" . $registro['s_Expirou'] . "</td>";
                $historico .= "<td>" . $registro['s_SID'] . "</td>";
                $historico .= "<td>" . $registro['XE_Cliente'] . "</td>";
                $historico .= "</tr>";
            }
        
            $historico .= "</tbody>";
            $historico .= "</table>";
        
            // Close database connection
            BD_Desconectar( $conexao_bd );
        
            return $historico;
        }
        
        // ************************************************************************************
        function Sessao_SESSION()
        {
            $sessao = "<pre>$_SESSION: <br>";
            
            //////////////////////////////////////////
            //$sessao .= print_r( ",", $_SESSION);            
            $tabela = "<table border=1><tr><th>Arquivos</th><th>Qtd Chamadas</th></tr>";
            foreach($_SESSION as $indice=>$valor) 
            {
                $tabela .= "<tr><td>". $indice."</td><td style='text-align: center;'>".$valor."</td></tr>";
            }
            $tabela .= "</table>";
            $sessao .= $tabela;
            ///////////////////////////////////////////
            
            $sessao .= "</pre>";
            return $sessao;
        }

?
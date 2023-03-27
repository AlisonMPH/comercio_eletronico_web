
<?php

    session_name("MPH");
    session_start();
    
	function connectBD()
	{
        $host = "localhost";
        $username = "myalisonmpda";
        $password = "7EswBZI6";
        $dbname = "mpheletronicos";
        return mysqli_connect($host, $username, $password, $dbname);
	}

	function createSession($bd, $userId, $sessionId) 
	{
		//global $mysqli;
		
		$sessionExpire = date('Y-m-d H:i:s', strtotime('+10 minutes'));
		$currentTime = date('Y-m-d H:i:s');
		
		$stmt = $bd->prepare("INSERT INTO SESSAO (S_Login, S_Utilizando, S_Expirou, S_SID) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $currentTime, $currentTime, $sessionExpire, $sessionId);
		$stmt->execute();
		$stmt->close();
	}

	function updateSessionWorkingTime($bd,$sessionId) {
		global $mysqli;
		
		$currentTime = date('Y-m-d H:i:s');
		
		$stmt = $bd->prepare("UPDATE SESSAO SET S_Utilizando = ? WHERE S_SID = ?");
		$stmt->bind_param("ss", $currentTime, $sessionId);
		$stmt->execute();
		$stmt->close();
	}

	function endSession($sessionId) {
		global $mysqli;
		
		$currentTime = date('Y-m-d H:i:s');
		
		$stmt = $mysqli->prepare("UPDATE Sessao SET S_Logout = ? WHERE S_SID = ?");
		$stmt->bind_param("ss", $currentTime, $sessionId);
		$stmt->execute();
		$stmt->close();
	}

	function getSessionUserId($sessionId) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT ID_CLIENTE FROM SESSAO WHERE S_SID = ? AND S_Expirou IS NULL AND S_Logout IS NULL AND TIMESTAMPDIFF(SECOND, S_Utilizando, NOW()) < 600");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$stmt->bind_result($userId);
		$stmt->fetch();
		$stmt->close();
		
		if ($userId) {
			updateSessionWorkingTime($sessionId);
		}
		
		return $userId;
	}

    function getSessionTable()
    {
        // Connect to database
        $conn = connectBD();
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Query the sessions table
        $sql = "SELECT * FROM SESSAO";
        $result = mysqli_query($conn, $sql);
    
        // Build HTML table
        $table = "<table>";
        $table .= "<thead><tr style='background-color: lightblue;'><th>XP</th><th>Login</th><th>Utilizando</th><th>Logout</th><th>Expirou</th><th>SID</th><th>XE_Usu</th></tr></thead>";
        $table .= "<tbody>";
    
        // Loop through results and add to table
        $row_count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $row_count++;
            if ($row_count % 2 == 0) {
                $table .= "<tr style='background-color: lightgreen;'>";
            } else {
                $table .= "<tr style='background-color: lightred;'>";
            }
            $table .= "<td>" . $row['XP_Sessao'] . "</td>";
            $table .= "<td>" . $row['S_Login'] . "</td>";
            $table .= "<td>" . $row['S_Utilizando'] . "</td>";
            $table .= "<td>" . $row['S_Logout'] . "</td>";
            $table .= "<td>" . $row['S_Expirou'] . "</td>";
            $table .= "<td>" . $row['S_SID'] . "</td>";
            $table .= "<td>" . $row['ID_CLIENTE'] . "</td>";
            $table .= "</tr>";
        }
    
        $table .= "</tbody>";
        $table .= "</table>";
    
        // Close database connection
        mysqli_close($conn);
    
        return $table;
    }
    
    function getSession()
    {
        $sessao = "<pre>$_SESSION: <br>";
        $sessao .= print_r($_SESSION);
        $sessao .= "</pre>";
        return $sessao;
    }

?>
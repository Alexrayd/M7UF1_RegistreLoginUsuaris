<?php
    $cadenaConn=$_GET['cadenaConn'];
    $passwd=$_GET['passwd'];
    $usuari=$_GET['usuari'];
    
    $conn=new PDO($cadenaConn,$usuari,$passwd);
    $activateCode=$_GET['activateCode'];
    $getUserExists= "SELECT COUNT(*) FROM Usuario WHERE activationCode =:activationCode";
    $stmt = $conn->prepare($getUserExists);
    $stmt->bindParam(':activationCode', $activateCode);
    $stmt->execute();
    $userCode = (int) $stmt->fetchColumn();

    if($userCode>0)
    {
        $verifyUser= "UPDATE Usuario SET Active = 1, activationCode=null WHERE activationCode =:activationCode "; 
        $stmt = $conn->prepare($verifyUser);
        $stmt->bindParam(':activationCode', $activateCode);
        $stmt->execute();
        if ($stmt->execute()) {
            header("Location: Home.php");
        } else {
            throw new Exception("Error al registrar el usuario. Inténtalo de nuevo.");
        }
    }
?>
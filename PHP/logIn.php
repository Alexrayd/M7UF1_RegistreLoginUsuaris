<?php
    $cadenaConn="mysql:dbname=mysql;host=localhost:3335";
    $passwd='';
    $usuari='root';

    try {
        $conn = new PDO($cadenaConn,$usuari,$passwd);
        $password1=$_POST["loginPassword"];
        $password = hash('sha256',$password1);
        $email = $_POST["loginEmail"];
        
        if (!$email || !$password) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $getUserExists= "SELECT COUNT(*) FROM Usuario WHERE Email =:mail AND Passwd=:passwd";
        $stmt = $conn->prepare($getUserExists);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':passwd',$password);
        $stmt->execute();

        $userCount = (int) $stmt->fetchColumn();

        if($userCount>0)
        {
            $getUserActive="SELECT Active FROM Usuario WHERE Email =:mail ";
            $stmt = $conn->prepare($getUserActive);
            $stmt->bindParam(':mail', $email);
            $stmt->execute();

            $userActive = (int) $stmt->fetchColumn();
            if ($userActive === 1) {
                header("Location: Home.php");
            } else {
                header("Location: ../HTML/ActivaCuenta.html");
            }
            exit(); 
        }
        else{
            header("Location: ../index.php");
            echo("La contraseña o correo son erroneos");
        }
        
        $conn=null;
    }catch(PDOException $e){
        echo "Error ".$e->getMessage();
        $conn=null;
    }
?>
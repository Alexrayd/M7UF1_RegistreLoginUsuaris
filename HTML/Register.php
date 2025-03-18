<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    $cadenaConn="mysql:dbname=mysql;host=localhost:3335";
    $passwd='';
    $usuari='root';
    $activationCode="";

    $activado=0;
    try {
        $conn = new PDO($cadenaConn,$usuari,$passwd);

        $userName = $_POST["registerUsername"];
        $password = $_POST["registerPassword"];
        $email = $_POST["registerEmail"];
        $name = $_POST["registerName"];
        $lastName = $_POST["registerSurname"];
        $activationDate=null;

        //$resetPassExpiry=null;
        //$resetPassCode=;
        //$Active=;
        
        if (!$userName || !$email || !$password || !$name || !$lastName) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $getUserExists= "SELECT COUNT(*) FROM Usuario WHERE Email=:email";
        $getUsernameUsed="SELECT COUNT(*) FROM Usuario WHERE Usuario=:name";
        $stmt = $conn->prepare($getUserExists);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt2= $conn->prepare($getUsernameUsed);
        $stmt2->bindParam(':name',$name);
        $stmt2->execute();
        
        $userCount = (int) $stmt->fetchColumn();
        $userCount2= (int) $stmt2->fetchColumn();
        if($userCount>0)
        {
            echo("El correo '$email' ya está registrado. Por favor, elige otro.");
        }
        else if($userCount2>0)
        {
            echo("El nombre de usuario '$name' ya está registrado. Porfavor elige otro.");
        }
        else{
            $PasswdEncriptada = hash('sha256',$password);
            $activationCode=hash('sha256',generaCodigo($conn));
            $addUser= "INSERT INTO usuario VALUES (:user,:passwd,:correo,:nombre,:apellido,:dataActivacio,:codiActivacio,null,null,:activado)";
            $stmt = $conn->prepare($addUser);
            $stmt->bindParam(':user', $userName);
            $stmt->bindParam(':correo', $email);
            $stmt->bindParam(':passwd', $PasswdEncriptada);
            $stmt->bindParam(':nombre',$name);
            $stmt->bindParam(':apellido',$lastName);
            $stmt->bindParam(':dataActivacio',$activationDate);
            $stmt->bindParam(':codiActivacio',$activationCode);
            $stmt->bindParam(':activado',$activado);
            
            $cadenaVerificacio="http://localhost/php/Redirect.php?activateCode=".
            $activationCode."&cadenaConn=".$cadenaConn."&usuari=".$usuari."&passwd=".$passwd;
            if ($stmt->execute()) {
                enviaCorreo($email,$cadenaVerificacio);
                header("Location: ActivaCuenta.html");
            } else {
                throw new Exception("Error al registrar el usuario. Inténtalo de nuevo.");
            }
        }
        
        $conn=null;
    }catch(PDOException $e){
        echo "Error ".$e->getMessage();
        $conn=null;
    }

    function enviaCorreo($email,$cadenaVerificacio)
    {
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        //Dades del correu electrònic
        $mail->SetFrom('alex.batllesf@educem.net','TinclerMail');
        $mail->Subject = 'registroExitosoTest';
        $mail->AddEmbeddedImage('../Images/LogoNicler.jpg', 'logo', 'LogoNicler.jpg');
        $mail->isHTML(true);
        $mail->Body = '<h2>¡Bienvenido a NICLER!</h2>
        <img src="cid:logo" alt="Logo de la empresa" style="width: 200px; margin-top: 20px;">
        <a href="'.$cadenaVerificacio.'">ACTIVA TU CUENTA</a>';        
        
        //Credencials del compte GMAIL
        $mail->Username = 'alex.batllesf@educem.net';
        $mail->Password = 'vtmt hamr bpjd cvms'; // La contraseña se saca de la verificación de dos pasos de gmail
        
        //Destinatari
        $address =$email;
        $mail->AddAddress($address, 'Test');
        //Enviament
        $result = $mail->Send();
        if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
        }else{
        echo "Correu enviat";
        }
    }

    function generaCodigo($conn)
    {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codigo = '';
        $existe=true;

        while($existe)
        {
            for($i=0;$i<10;$i++)
            {
                $codigo=$codigo.$caracteres[rand(0,strlen($caracteres)-1)];
            }
            $existe=existeCodigo($codigo,$conn);  
        }
        return $codigo;
    }

    function existeCodigo($codigo,$conn)
    {
        $existe=false;

        $getCodeExists= "SELECT COUNT(*) FROM Usuario WHERE activationCode =:code";
        $stmt = $conn->prepare($getCodeExists);
        $stmt->bindParam(':code', $codigo);
        $stmt->execute();

        $userCode = (int) $stmt->fetchColumn();
        if($userCode>0)
        {
            $existe=true;
        }
        return $existe;
    }
?>
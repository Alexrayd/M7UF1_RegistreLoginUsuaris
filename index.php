<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login y Registro</title>
  <link rel="icon" href="../Images/LogoNicler.jpg">
  <link rel="stylesheet" href="../CSS/Log_In.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <img src="../Images/Nicler.png" alt="Nicler" id="Nicler">
  </header>
  <div class="logo-placeholder">
    <img src="../Images/LogoNicler.jpg" alt="Logo" id="logo">
  </div>
  <div class="card">
    
    <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">
          Iniciar Sesión
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">
          Registrarse
        </button>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
        <form action="/PHP/logIn.php" method="POST" >
          <div class="mb-4">
            <label for="loginEmail" class="form-label">Correo Electrónico</label>
            <input type="email" name ="loginEmail" class="form-control"  placeholder="correo@ejemplo.com" required>
          </div>
          <div class="mb-4">
            <label for="loginPassword" class="form-label">Contraseña</label>
            <input type="password" name= "loginPassword" class="form-control"  placeholder="Contraseña" required>
          </div>
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="form-check m-0">
              <input type="checkbox" class="form-check-input" id="loginRemember">
              <label class="form-check-label" for="loginRemember">Recordarme</label>
            </div>
            <a href="#" id="openPopup" class="text-primary text-decoration-none">Forgot Password?</a>
          </div>

          <div class="mb-4 text-center">
            <a href="#pills-register" class="text-primary text-decoration-none" onclick="showRegisterTab()">¿No tienes cuenta? Regístrate</a>
          </div>

          
          <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
      </div>

      <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
        <form action="/HTML/Register.php" method="POST">
          <div class="mb-4">
            <label for="registerUsername" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="registerUsername" name="registerUsername" placeholder="Nombre de Usuario" required>
          </div> 
          <div class="mb-4">
            <label for="registerName" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="registerName" name="registerName" placeholder="Tu Nombre" required>
          </div>
          <div class="mb-4">
            <label for="registerSurname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="registerSurname" name="registerSurname" placeholder="Tu Apellido" required>
          </div>
          <div class="mb-4">
            <label for="registerEmail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="correo@ejemplo.com" required>
          </div>
          <div class="mb-4">
            <label for="registerPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Contraseña" required>
          </div>
          <div class="mb-4">
            <label for="registerRepeatPassword" class="form-label">Repetir Contraseña</label>
            <input type="password" class="form-control" id="registerRepeatPassword" name="registerRepeatPassword" placeholder="Repetir Contraseña" required>
          </div>
          <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="registerTerms" required>
            <label class="form-check-label" for="registerTerms">Acepto los <a href="#">términos y condiciones</a></label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
      </div>
    </div>
  </div>

  <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Formulario de Contacto</h2>
            <form id="formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

  <script src="/JS/ForgotPassword.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

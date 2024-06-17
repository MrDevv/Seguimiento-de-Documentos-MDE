<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEGUIMIENTO DE DOCUMENTOS</title>
    <link rel="stylesheet" href="/estilo/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="/login/image/Municipalida.png" alt="escudo" class="logo">
        </div>
        <div class="login-right">
            <h2 class="login-right2">SEGUIMIENTO DE DOCUMENTOS INTERNOS Y EXTERNOS</h2>
            <H3>¡Hola!</H3>
            <p>Ingresa tus datos para iniciar sesión</p>
            <form id="loginForm">
                <label for="username">Usuario:</label>
                <input type="text" required>

                <label for="password">Contraseña:</label>
                <input type="password" required> </br>

                <button type="submit">Ingresar</button>
            </form>
            <p id="message"></p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<div class="login-container">
        <div class="login-left">
            <img class="logo-login" src="<?=base_url?>assets/logo2.png" alt="logo">
        </div>
        <div class="login-right">
            <h2 class="login-title">seguimiento de documentos internos y externos</h2>
            <p>Ingresa tus datos para iniciar sesión</p>
            <form action="<?=base_url?>usuario/login" method="post">
                <label for="username">Usuario:</label>
                <input type="text" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required> </br>

                <button type="submit">Ingresar</button>
            </form>
        </div>
</div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="assets/css/stylesAdministrado.css">
</head>
<body>
    <div class="container">
        <form>
            <div class="section">
                <h2>Datos Generales</h2>
                <div class="form-group">
                    <div class="column">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="Rodrigo">
                    </div>
                    <div class="column">
                        <label for="area">Área:</label>
                        <select id="area" name="area">
                            <option value="">Seleccione</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="column">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" value="Estrada León">
                    </div>
                    <div class="column">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <option value="habilitado">Habilitado</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="column">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono">
                    </div>
                    <div class="column">
                        <!-- espacio vacío para alinear correctamente -->
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Datos de Usuario</h2>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="restradal" disabled>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="user-input">
                </div>
            </div>

            <div class="button-container">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>
</body>
</html>




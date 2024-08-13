CREATE PROCEDURE sp_registrarUsuario(
	@nombres VARCHAR(30), @apellidos VARCHAR(30), @telefono VARCHAR(9), @dni VARCHAR(8),
	@nombreUsuario VARCHAR(20), @codRol INT, @password VARCHAR(50),
	@codArea INT
)
AS
BEGIN

	DECLARE @codEstadoActivo INT
	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a'

    INSERT INTO Persona(nombres, apellidos, telefono, dni, codEstado)
	VALUES(@nombres, @apellidos, @telefono, @dni, @codEstadoActivo)

    DECLARE @codPersonaInsert INT;
    SET @codPersonaInsert = SCOPE_IDENTITY();

	INSERT INTO Usuario(nombreUsuario, codRol, codPersona, password, codEstado) 
    VALUES(@nombreUsuario, @codRol, @codPersonaInsert, @password, @codEstadoActivo)

	DECLARE @codUsuarioInsert INT;
    SET @codUsuarioInsert = SCOPE_IDENTITY();

	INSERT INTO UsuarioArea(codUsuario, codArea, codEstado)
    VALUES(@codUsuarioInsert, @codArea, @codEstadoActivo)
END
GO
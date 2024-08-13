-- actualizar los datos de una persona
CREATE PROCEDURE sp_actualizarUsuarioPersona(
	@codPersona INT, @nombres VARCHAR(50), @apellidos VARCHAR(50), @telefono VARCHAR(9), @dni VARCHAR(8), @codRol INT, @usuario VARCHAR(50)
)
AS
BEGIN 
	UPDATE Persona SET nombres = @nombres, apellidos = @apellidos, telefono = @telefono, dni = @dni WHERE codPersona = @codPersona;

	UPDATE Usuario SET codRol = @codRol, nombreUsuario = @usuario WHERE codPersona = @codPersona;
END
GO

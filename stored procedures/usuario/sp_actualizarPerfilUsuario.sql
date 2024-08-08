CREATE PROCEDURE sp_actualizarPerfilUsuario(
	@codPersona INT, 
	@codUsuario INT, 
	@nombres VARCHAR(50), 
	@apellidos VARCHAR(50),
	@telefono VARCHAR(9),
	@dni VARCHAR(8),
	@passoword VARCHAR(50) NULL
)
AS
BEGIN
	UPDATE Persona SET nombres = @nombres, apellidos = @apellidos, telefono = @telefono, dni = @dni
	WHERE codPersona = @codPersona;

	IF @passoword IS NOT NULL
	BEGIN
		UPDATE Usuario SET password = @passoword
		WHERE codUsuario = @codUsuario;
	END
END
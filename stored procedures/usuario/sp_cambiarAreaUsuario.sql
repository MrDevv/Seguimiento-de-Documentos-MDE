-- procedimiento almacenado para cambiar de area a un usuario
CREATE PROCEDURE sp_cambiarAreaUsuario(
	@codUsuarioArea INT, @codUsuario INT, @codArea INT
)
AS
BEGIN 
	DECLARE @codEstadoInactivoUsuarioArea INT
	DECLARE @codEstadoActivoUsuarioArea INT
	DECLARE @codUltimaArea INT

	SELECT @codEstadoInactivoUsuarioArea = codEstado FROM Estado WHERE descripcion = 'i'
	SELECT @codEstadoActivoUsuarioArea = codEstado FROM Estado WHERE descripcion = 'a'

	SELECT @codUltimaArea = codUsuarioArea FROM UsuarioArea WHERE codUsuario= @codUsuario and codArea = @codArea

	UPDATE UsuarioArea SET codEstado = @codEstadoInactivoUsuarioArea WHERE codUsuarioArea = @codUsuarioArea;

	IF @codUltimaArea IS NOT NULL
	BEGIN		
		UPDATE UsuarioArea SET codEstado = @codEstadoActivoUsuarioArea WHERE codUsuarioArea = @codUltimaArea;
	END
	ELSE 
	BEGIN		
		INSERT INTO UsuarioArea(codUsuario, codArea, codEstado) VALUES(@codUsuario, @codArea, @codEstadoActivoUsuarioArea)
	END
END
GO
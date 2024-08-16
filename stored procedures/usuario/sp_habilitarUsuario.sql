CREATE PROCEDURE sp_habilitarUsuario(
	@codUsuarioArea INT
)
AS 
BEGIN
	DECLARE @codEstadoActivo INT
	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	UPDATE UsuarioArea SET codEstado = @codEstadoActivo
	where codUsuarioArea = @codUsuarioArea
END
GO
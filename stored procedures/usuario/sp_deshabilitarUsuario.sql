CREATE PROCEDURE sp_deshabilitarUsuario(
	@codUsuarioArea INT
)
AS 
BEGIN
	DECLARE @codEstadoPausa INT

	SELECT @codEstadoPausa = codEstado FROM Estado WHERE descripcion = 'p';

	UPDATE UsuarioArea SET codEstado = @codEstadoPausa
	where codUsuarioArea = @codUsuarioArea
END
GO

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
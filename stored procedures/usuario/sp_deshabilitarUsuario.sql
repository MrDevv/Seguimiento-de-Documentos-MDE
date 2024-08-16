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
CREATE PROCEDURE sp_finalizarSeguimientoDocumento(
	@numDocumento VARCHAR(40)
)
AS
BEGIN
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	UPDATE Documento SET codEstado = @codEstadoInactivo WHERE NumDocumento = @numDocumento
END
GO

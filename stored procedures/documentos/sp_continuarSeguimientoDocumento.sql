/** procedimiento para continuar con el seguimiento de un documento,
recibe como parametro el número del documento **/
CREATE PROCEDURE sp_continuarSeguimientoDocumento(
	@numDocumento VARCHAR(20)
)
AS
BEGIN
	DECLARE @codEstadoActivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	UPDATE Documento SET codEstado = @codEstadoActivo WHERE NumDocumento = @numDocumento
END
GO
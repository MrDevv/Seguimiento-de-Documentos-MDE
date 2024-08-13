CREATE PROCEDURE sp_cancelarRecepcion(
	@codRecepcion INT
)
AS BEGIN
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	UPDATE Recepcion SET codEstado = @codEstadoInactivo, fechaRecepcion = null, horaRecepcion = null where codRecepcion = @codRecepcion;
END
GO
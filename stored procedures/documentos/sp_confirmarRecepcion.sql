CREATE PROCEDURE sp_confirmarRecepcion(
	@codRecepcion INT, @horaRecepcion TIME, @fechaRecepcion DATE
)
AS
BEGIN
	DECLARE @codEstadoActivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	UPDATE Recepcion SET codEstado = @codEstadoActivo, horaRecepcion = @horaRecepcion, fechaRecepcion = @fechaRecepcion 
	WHERE codRecepcion = @codRecepcion
END
GO
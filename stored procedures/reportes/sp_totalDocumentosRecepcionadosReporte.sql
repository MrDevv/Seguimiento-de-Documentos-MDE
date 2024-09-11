-- generar reporte de los documentos recepcionados por un usuario por fecha
CREATE PROCEDURE sp_totalDocumentosRecepcionadosReporte(
	@codUsuarioArea INT, 
	@fechaInicio DATE = NULL,
	@fechaFin DATE = NULL,
	@numDocumento VARCHAR(40) = ''
)
AS
BEGIN
		DECLARE @CodEstadoActivo INT

		SELECT @CodEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

		SELECT 
		COUNT(r.codRecepcion) 'total'
		FROM Recepcion r
		INNER JOIN Envio e ON r.codEnvio = e.codEnvio
		WHERE r.codUsuarioRecepcion = @codUsuarioArea AND r.codEstado = @CodEstadoActivo
		AND (@fechaInicio IS NULL OR r.fechaRecepcion >= @fechaInicio)
        AND (@fechaFin IS NULL OR r.fechaRecepcion <= @fechaFin)
		AND e.NumDocumento LIKE '%'+@numDocumento+'%'
END
GO
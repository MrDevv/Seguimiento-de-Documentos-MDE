-- generar total de los documentos enviados por un usuario por fecha
CREATE PROCEDURE sp_totalDocumentosEnviadosReporte(
	@codUsuarioArea INT, 
	@fechaInicio DATE = NULL,
	@fechaFin DATE = NULL,
	@numDocumento VARCHAR(20) = ''
)
AS
BEGIN
		SELECT
        COUNT (e.codEnvio) 'total'
        from Recepcion r 
        INNER JOIN Envio e on r.codEnvio = e.codEnvio 
        WHERE e.codUsuarioEnvio =  @codUsuarioArea
		AND (@fechaInicio IS NULL OR e.fechaEnvio >= @fechaInicio)
		AND (@fechaFin IS NULL OR e.fechaEnvio <= @fechaFin)
		AND e.NumDocumento LIKE '%'+@numDocumento+'%'
END
GO
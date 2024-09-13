-- generar total de los documentos enviados por un usuario por fecha
CREATE PROCEDURE sp_totalDocumentosEnviadosReporte(
	@codUsuarioArea INT, 
	@fechaInicio DATE = NULL,
	@fechaFin DATE = NULL,
	@numDocumento VARCHAR(40) = ''
)
AS
BEGIN
		SELECT
        COUNT (e.codEnvio) 'total'
        from Recepcion r 
        INNER JOIN Envio e on r.codEnvio = e.codEnvio
		INNER JOIN Documento d on e.numRegistro = d.numRegistro
        WHERE e.codUsuarioEnvio =  @codUsuarioArea
		AND (@fechaInicio IS NULL OR e.fechaEnvio >= @fechaInicio)
		AND (@fechaFin IS NULL OR e.fechaEnvio <= @fechaFin)
		AND d.NumDocumento LIKE '%'+@numDocumento+'%'
END
GO
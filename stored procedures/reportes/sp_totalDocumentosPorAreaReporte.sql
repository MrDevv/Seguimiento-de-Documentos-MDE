CREATE PROCEDURE sp_totalDocumentosPorAreaReporte(
	@codArea INT = NULL, 
	@numDocumento VARCHAR(40) = NULL
)
AS
BEGIN	
	WITH UltimosEnvios AS (
        SELECT
            NumDocumento,
            MAX(codEnvio) AS UltimoCodEnvio
        FROM Envio
        GROUP BY NumDocumento
		)    
		SELECT
			COUNT (d.NumDocumento) 'total'			
		FROM
			Documento d
		INNER JOIN UltimosEnvios ue ON d.NumDocumento = ue.NumDocumento
		INNER JOIN Envio e ON ue.UltimoCodEnvio = e.codEnvio
		INNER JOIN UsuarioArea ua ON e.codUsuarioDestino = ua.codUsuarioArea						
		WHERE (@codArea IS NULL OR ua.codArea = @codArea) 
		AND (@numDocumento IS NULL OR e.NumDocumento = @numDocumento)		
END
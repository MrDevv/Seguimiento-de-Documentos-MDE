CREATE PROCEDURE sp_totalDocumentosPorAreaReporte(
	@codArea INT = NULL, 
	@numDocumento VARCHAR(40) = NULL
)
AS
BEGIN	
	WITH UltimosEnvios AS (
        SELECT
            numRegistro,
            MAX(codEnvio) AS UltimoCodEnvio
        FROM Envio
        GROUP BY numRegistro
		)    
		SELECT
			COUNT (d.NumDocumento) 'total'			
		FROM
			Documento d
		INNER JOIN UltimosEnvios ue ON d.numRegistro = ue.numRegistro
		INNER JOIN Envio e ON ue.UltimoCodEnvio = e.codEnvio
		INNER JOIN UsuarioArea ua ON e.codUsuarioDestino = ua.codUsuarioArea						
		WHERE (@codArea IS NULL OR ua.codArea = @codArea) 
		AND (@numDocumento IS NULL OR d.NumDocumento = @numDocumento)		
END
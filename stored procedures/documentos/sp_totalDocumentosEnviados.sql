CREATE PROCEDURE sp_totalDocumentosEnviados(
	@codUsuarioArea INT,
	@codArea INT = NULL
)
AS
BEGIN
	IF @codArea IS NULL
	BEGIN
			SELECT 
			COUNT (codRecepcion) 'total'
			FROM Recepcion r			
			INNER JOIN Envio e on r.codEnvio = e.codEnvio 
			WHERE e.codUsuarioEnvio =  @codUsuarioArea
	END
	ELSE
	BEGIN
			SELECT 
			COUNT (r.codRecepcion) 'total'			
			FROM Recepcion r
			INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
			INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
			INNER JOIN Area ae ON uae.codArea = ae.codArea			
			WHERE ae.codArea = @codArea
	END
END
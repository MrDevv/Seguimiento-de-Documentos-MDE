CREATE PROCEDURE sp_totalDocumentosRecepcionados(
	@codUsuarioArea INT,
	@codArea INT = NULL
)
AS
BEGIN
	DECLARE @CodEstadoActivo INT
	SELECT @CodEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	IF @codArea IS NULL
	BEGIN
			SELECT 
			COUNT (codRecepcion) 'total'
			FROM Recepcion				
			WHERE codUsuarioRecepcion = @codUsuarioArea AND codEstado = @CodEstadoActivo			
	END
	ELSE
	BEGIN
			SELECT 
			COUNT (r.codRecepcion) 'total'			
			FROM Recepcion r
			INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
			INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
			INNER JOIN Area ad ON uad.codArea = ad.codArea
			WHERE ad.codArea = @codArea AND r.codEstado = @CodEstadoActivo
	END
END
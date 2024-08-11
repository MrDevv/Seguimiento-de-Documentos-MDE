CREATE PROCEDURE sp_totalDocumentosPendientesRecepcion(
	@codUsuarioArea INT,
	@codArea INT = NULL
)
AS
BEGIN
	DECLARE @CodEstadoInactivo INT
	SELECT @CodEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	IF @codArea IS NULL
	BEGIN
			SELECT 
			COUNT (codRecepcion) 'total'
			FROM Recepcion				
			WHERE codUsuarioRecepcion = @codUsuarioArea AND codEstado = @CodEstadoInactivo
	END
	ELSE
	BEGIN
			SELECT 
			COUNT (r.codRecepcion) 'total'			
			FROM Recepcion r
			INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
			INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea 
			WHERE uad.codArea = @codArea AND r.codEstado = @CodEstadoInactivo
	END
END
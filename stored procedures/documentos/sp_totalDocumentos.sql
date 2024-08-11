CREATE PROCEDURE sp_totalDocumentos(
	@codAreaUsuario INT = NULL,
	@numDocumento VARCHAR(20) = NULL,
	@codArea INT = NULL
)
AS
BEGIN	
	IF @codArea IS NULL
	BEGIN
		SELECT COUNT(NumDocumento) 'total' 
		FROM Documento d
		INNER JOIN UsuarioArea ua on d.codUsuario = ua.codUsuarioArea
		WHERE 
		(@codAreaUsuario IS NULL OR ua.codUsuarioArea = @codAreaUsuario) 
		AND d.NumDocumento LIKE '%'+@numDocumento+'%'
	END
	ELSE
	BEGIN
		SELECT COUNT(NumDocumento) 'total' 
		FROM Documento d
		INNER JOIN UsuarioArea ua on d.codUsuario = ua.codUsuarioArea
		WHERE (ua.codArea  = @codArea) 
		AND d.NumDocumento LIKE '%'+@numDocumento+'%'
	END
END
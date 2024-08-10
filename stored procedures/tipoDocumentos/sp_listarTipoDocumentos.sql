-- procedimiento almacenado para listar todos los tipos de documentos
CREATE PROCEDURE sp_listarTipoDocumento(
	@pagina INT,
    @registrosPorPagina INT
)
AS
BEGIN
	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;

	SELECT * FROM TipoDocumento
	ORDER BY codTipoDocumento desc
	OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
END

exec sp_listarTipoDocumento 1, 10
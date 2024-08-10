-- procedimiento almacenado para listar todos los tipos de documentos
CREATE PROCEDURE sp_listarAreas(
	@pagina INT,
    @registrosPorPagina INT
)
AS
BEGIN
	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;

	SELECT * FROM Area
	ORDER BY codArea desc
	OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
END
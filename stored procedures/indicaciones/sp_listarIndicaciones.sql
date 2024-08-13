-- procedimiento almacenado para listar todos los tipos de documentos
CREATE PROCEDURE sp_listarIndicaciones(
	@pagina INT = 1,
    @registrosPorPagina INT = 10
)
AS
BEGIN
	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;

	SELECT * FROM Indicacion
	ORDER BY codIndicacion desc
	OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
END
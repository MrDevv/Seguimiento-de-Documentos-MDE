CREATE PROCEDURE sp_totalDocumentos(
	@numDocumento VARCHAR(20) = NULL
)
AS
BEGIN
	SELECT COUNT(NumDocumento) 'total' FROM Documento
	WHERE NumDocumento LIKE '%'+@numDocumento+'%'
END
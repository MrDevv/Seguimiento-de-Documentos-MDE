CREATE PROCEDURE sp_totalDocumentos(
	@numDocumento VARCHAR(20) = NULL
)
AS
BEGIN
	SELECT COUNT(NumDocumento) 'total' FROM Documento
	WHERE NumDocumento LIKE '%'+@numDocumento+'%'
END


exec sp_listarDocumentos null, '2024', null, 1, 10
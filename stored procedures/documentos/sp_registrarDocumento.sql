CREATE PROCEDURE sp_registrarDocumento(
	@numDocumento VARCHAR(20), @asunto VARCHAR(300), @folios INT, @codTipoDocumento INT, 
	@usuario INT, @fechaRegistro DATE, @horaRegistro TIME
)
AS
BEGIN
	DECLARE @codEstadoNuevo INT;

	SELECT @codEstadoNuevo = codEstado FROM Estado WHERE descripcion = 'n';

	INSERT INTO Documento(NumDocumento, asunto, folios, codTipoDocumento, fechaRegistro, horaRegistro, codUsuario, codEstado)
    VALUES(@numDocumento, @asunto, @folios, @codTipoDocumento, @fechaRegistro, @horaRegistro, @usuario, @codEstadoNuevo)
END
GO
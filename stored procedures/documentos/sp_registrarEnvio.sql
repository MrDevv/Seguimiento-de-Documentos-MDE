CREATE PROCEDURE sp_registrarEnvio(
	@codRecepcion INT NULL, @folios INT, @codIndicacion INT, 
	@observacion VARCHAR(300) NULL, @codUsuarioAreaDestino INT,@codUsuarioAreaEnvio INT, @fechaEnvio DATE, @horaEnvio TIME,
	@numRegistro INT
)
AS
BEGIN
	DECLARE @codEstadoActivo INT;
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';
	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	INSERT INTO Envio 
		(fechaEnvio, horaEnvio, folios, observaciones, codEstado, codIndicacion, numRegistro, codUsuarioEnvio, codUsuarioDestino)
    VALUES (@fechaEnvio, @horaEnvio, @folios, @observacion, @codEstadoActivo, @codIndicacion, @numRegistro, @codUsuarioAreaEnvio, @codUsuarioAreaDestino)

	DECLARE @codEnvioInsert INT;
    SET @codEnvioInsert = SCOPE_IDENTITY();

	UPDATE Documento SET codEstado = @codEstadoActivo where numRegistro = @numRegistro

	IF @codRecepcion IS NOT NULL
	BEGIN
		DECLARE @codEstadoEnviado INT

		SELECT @codEstadoEnviado = codEstado FROM Estado WHERE descripcion = 'e';

		UPDATE Recepcion SET codEstado = @codEstadoEnviado WHERE codRecepcion = @codRecepcion
	END

	INSERT INTO Recepcion(codEnvio, codEstado, codUsuarioRecepcion)
    VALUES(@codEnvioInsert, @codEstadoInactivo, @codUsuarioAreaDestino);
END
GO
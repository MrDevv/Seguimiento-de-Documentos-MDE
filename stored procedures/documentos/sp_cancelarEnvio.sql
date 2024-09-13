CREATE PROCEDURE sp_cancelarEnvio(
	@codEnvio INT
)
AS BEGIN
	DECLARE @codEstado INT;
	DECLARE @codUltimaRecepcion INT;
	DECLARE @numRegistro INT;

	SELECT @numRegistro = numRegistro FROM Envio WHERE codEnvio = @codEnvio;

	DELETE FROM Recepcion where codEnvio = @codEnvio;
	DELETE FROM Envio where codEnvio = @codEnvio

	SELECT TOP 1 @codUltimaRecepcion = r.codRecepcion
	FROM Recepcion r INNER JOIN envio e on r.codEnvio = e.codEnvio
	WHERE e.numRegistro = @numRegistro
	ORDER BY r.fechaRecepcion DESC, r.horaRecepcion DESC;

	IF @codUltimaRecepcion IS NOT NULL
	BEGIN
		SELECT @codEstado = codEstado FROM Estado WHERE descripcion = 'a';
		UPDATE Recepcion SET codEstado = @codEstado WHERE codRecepcion = @codUltimaRecepcion;
	END
	ELSE 
	BEGIN
		SELECT @codEstado = codEstado FROM Estado WHERE descripcion = 'n';
		UPDATE Documento SET codEstado = @codEstado WHERE numRegistro = @numRegistro;
	END
END
GO
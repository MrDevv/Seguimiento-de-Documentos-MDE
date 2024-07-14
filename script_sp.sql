-------------PROCEDIMIENTOS ALMACENADOS DEL SISTEMA

-------- Modulo Documentos

-- sp para listar los documentos registrados
CREATE PROCEDURE sp_listarDocumentos(
	@codUsuario INT = NULL
)
AS 
BEGIN
	SET NOCOUNT ON;

	SELECT d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
                CONCAT(p.nombres ,' ',p.apellidos) 'usuario registrador', e.descripcion 'estado'
                from Documento d
                inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
                inner join UsuarioArea ua on d.codUsuario = ua.codUsuario
                inner join Usuario u on ua.codUsuario = u.codUsuario
                inner join Persona p on u.codPersona = p.codPersona
                inner join Estado e on d.codEstado = e.codEstado
                where @codUsuario IS NULL OR ua.codUsuario = @codUsuario
                order by d.fechaRegistro DESC, d.horaRegistro DESC
END


EXEC sp_listarDocumentos @codUsuario = 4

---------------------------------------------------------------------------

-- listar el seguimiento de un documento

CREATE PROCEDURE sp_verSeguimientoDocumento(
	@NumDocumento VARCHAR(20)
)
AS BEGIN
	SELECT  e.codEnvio, 
			   LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
			   e.fechaEnvio,
			   e.folios, 
			   e.observaciones,
			   d.NumDocumento, 
			   td.descripcion 'tipo documento',
			   CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
			   ae.descripcion 'area origen',
			   CONCAT(pd.nombres, ' ' ,pd.apellidos) 'usuario destino', 
			   ad.descripcion 'area destino',
			   LEFT(CONVERT(VARCHAR, r.horaRecepcion, 108), 5) AS 'hora recepcion', 
			   r.fechaRecepcion,
			   er.descripcion 'estado recepcion',
			   (SELECT e.descripcion FROM Documento AS d INNER JOIN Estado e ON d.codEstado = e.codEstado
				WHERE NumDocumento = @NumDocumento) AS 'Estado Documento'
				from Recepcion r
				inner join Envio e on r.codEnvio = e.codEnvio
				-- Datos del documento
				INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
				-- Datos del tipo documento
				INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
				-- Usuario origen
				INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
				INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
				INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
				-- �rea origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- �rea destino 
				INNER JOIN Area ad ON uad.codArea = ad.codArea
				-- Estado de la recepcion
				INNER JOIN Estado er ON r.codEstado = er.codEstado
				where e.NumDocumento = @NumDocumento
				ORDER BY e.fechaEnvio ASC, e.horaEnvio ASC
END


EXEC sp_verSeguimientoDocumento @NumDocumento = '9013';

---------------------------------------------------------------------------

-- cancelar envio
CREATE PROCEDURE sp_cancelarEnvio(
	@codEnvio INT
)
AS BEGIN
	DECLARE @codEstado INT;
	DECLARE @codUltimaRecepcion INT;
	DECLARE @NumDocumento VARCHAR(20);

	SELECT @NumDocumento = NumDocumento FROM Envio WHERE codEnvio = @codEnvio;

	DELETE FROM Recepcion where codEnvio = @codEnvio;
	DELETE FROM Envio where codEnvio = @codEnvio

	SELECT TOP 1 @codUltimaRecepcion = r.codRecepcion
	FROM Recepcion r INNER JOIN envio e on r.codEnvio = e.codEnvio
	WHERE e.NumDocumento = @NumDocumento
	ORDER BY r.fechaRecepcion DESC, r.horaRecepcion DESC;

	IF @codUltimaRecepcion IS NOT NULL
	BEGIN
		SELECT @codEstado = codEstado FROM Estado WHERE descripcion = 'a';
		UPDATE Recepcion SET codEstado = @codEstado WHERE codRecepcion = @codUltimaRecepcion;
	END
	ELSE 
	BEGIN
		SELECT @codEstado = codEstado FROM Estado WHERE descripcion = 'n';
		UPDATE Documento SET codEstado = @codEstado WHERE NumDocumento = @NumDocumento;
	END
END

-----------------------------------------------------------------------------------------

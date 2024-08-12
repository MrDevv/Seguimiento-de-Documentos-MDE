-------------PROCEDIMIENTOS ALMACENADOS DEL SISTEMA

-------- Modulo Documentos

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
				INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
				INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
				INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
				-- 햞ea origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- 햞ea destino 
				INNER JOIN Area ad ON uad.codArea = ad.codArea
				-- Estado de la recepcion
				INNER JOIN Estado er ON r.codEstado = er.codEstado
				where e.NumDocumento = @NumDocumento
				ORDER BY e.fechaEnvio ASC, e.horaEnvio ASC
END
GO

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
GO

-----------------------------------------------------------------------------------------

-- ver detalle de un envio
CREATE PROCEDURE sp_verDetalleEnvio(
	@codEnvio INT
)
AS 
BEGIN
	SELECT  e.codEnvio, 
			   LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
			   e.fechaEnvio,
			   e.folios, 
			   e.observaciones,
			   d.NumDocumento, 
			   td.descripcion 'tipo documento',
			   CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
			   ae.descripcion 'area origen',
			   ee.descripcion 'estado envio',
			   CONCAT(pd.nombres, ' ' ,pd.apellidos) 'usuario destino', 
			   ad.descripcion 'area destino',
			   LEFT(CONVERT(VARCHAR, r.horaRecepcion, 108), 5) AS 'hora recepcion', 
			   r.fechaRecepcion,
			   er.descripcion 'estado recepcion',
			   ed.descripcion 'estado documento'
				from Recepcion r
				inner join Envio e on r.codEnvio = e.codEnvio
				-- Datos del documento
				INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
				-- Datos del tipo documento
				INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
				-- Estado del documento
				INNER JOIN Estado ed ON d.codEstado= ed.codEstado
				-- Usuario origen
				INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
				INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
				INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
				-- Estado del envio
				INNER JOIN Estado ee ON e.codEstado = ee.codEstado
				-- 햞ea origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- 햞ea destino 
				INNER JOIN Area ad ON uad.codArea = ad.codArea
				-- Estado de la recepcion
				INNER JOIN Estado er ON r.codEstado = er.codEstado			
				where e.codEnvio = @codEnvio
END
GO

-----------------------------------------------------------------------------------------

-- cancelar Recepcion
CREATE PROCEDURE sp_cancelarRecepcion(
	@codRecepcion INT
)
AS BEGIN
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	UPDATE Recepcion SET codEstado = @codEstadoInactivo, fechaRecepcion = null, horaRecepcion = null where codRecepcion = @codRecepcion;
END
GO

-------------------------------------------------------------------------------------------

-- autenticar usuario
CREATE PROCEDURE sp_autenticarUsuario(
	@nombreUsuario VARCHAR(15), @password VARCHAR(20)
)
AS
BEGIN
	DECLARE @codEstadoActivoUsuario INT

	SELECT @codEstadoActivoUsuario = codEstado FROM Estado WHERE descripcion = 'a';

	SELECT ua.codUsuarioArea ,ua.codUsuario, u.nombreUsuario, CONCAT(p.nombres, ' ',p.apellidos) 'nombres',
	r.descripcion 'rol',a.codArea, a.descripcion 'area', e.descripcion 'estado usuario'
	FROM UsuarioArea ua
	INNER JOIN Usuario u ON u.codUsuario = ua.codUsuario
	INNER JOIN Rol r ON u.codRol = r.codRol
	INNER JOIN Area a ON ua.codArea = a.codArea
	INNER JOIN Persona p ON u.codPersona = p.codPersona
	INNER JOIN Estado e ON ua.codEstado = e.codEstado
	WHERE u.nombreUsuario = @nombreUsuario AND u.password = @password AND ua.codEstado = @codEstadoActivoUsuario
END
GO

--------------------------------------------------------------------------------------------------------------
-- listar usuarios por Areas
CREATE PROCEDURE sp_listarUsuariosPorArea(
 @codArea INT = NULL, @codUsuarioArea INT = NULL
)
AS 
BEGIN
	DECLARE @codEstadoActivo INT

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	select ua.codUsuarioArea, concat(p.nombres, ' ' ,p.apellidos) 'usuario' 
                        from UsuarioArea ua 
                        inner join Area a on ua.codArea = a.codArea
                        inner join Usuario u on ua.codUsuario = u.codUsuario
                        inner join Persona p on u.codPersona = p.codPersona 
                        where
						(@codArea IS NULL OR a.codArea = @codArea)
						and 
						(@codUsuarioArea IS NULL OR ua.codUsuario != @codUsuarioArea)
						and ua.codEstado = @codEstadoActivo
END
GO

------------------------------------------------------------------------------------------------------------------

-- registrar usuario

CREATE PROCEDURE sp_registrarUsuario(
	@nombres VARCHAR(30), @apellidos VARCHAR(30), @telefono VARCHAR(9), @dni VARCHAR(8),
	@nombreUsuario VARCHAR(20), @codRol INT, @password VARCHAR(50),
	@codArea INT
)
AS
BEGIN

	DECLARE @codEstadoActivo INT
	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a'

    INSERT INTO Persona(nombres, apellidos, telefono, dni, codEstado)
	VALUES(@nombres, @apellidos, @telefono, @dni, @codEstadoActivo)

    DECLARE @codPersonaInsert INT;
    SET @codPersonaInsert = SCOPE_IDENTITY();

	INSERT INTO Usuario(nombreUsuario, codRol, codPersona, password, codEstado) 
    VALUES(@nombreUsuario, @codRol, @codPersonaInsert, @password, @codEstadoActivo)

	DECLARE @codUsuarioInsert INT;
    SET @codUsuarioInsert = SCOPE_IDENTITY();

	INSERT INTO UsuarioArea(codUsuario, codArea, codEstado)
    VALUES(@codUsuarioInsert, @codArea, @codEstadoActivo)
END
GO

---------------------------- MODULO USUARIO --------------------------------

-- actualizar los datos de una persona
CREATE PROCEDURE sp_actualizarUsuarioPersona(
	@codPersona INT, @nombres VARCHAR(50), @apellidos VARCHAR(50), @telefono VARCHAR(9), @dni VARCHAR(8), @codRol INT, @usuario VARCHAR(50)
)
AS
BEGIN 
	UPDATE Persona SET nombres = @nombres, apellidos = @apellidos, telefono = @telefono, dni = @dni WHERE codPersona = @codPersona;

	UPDATE Usuario SET codRol = @codRol, nombreUsuario = @usuario WHERE codPersona = @codPersona;
END
GO

-- cambiar de area a un usuario
CREATE PROCEDURE sp_cambiarAreaUsuario(
	@codUsuarioArea INT, @codUsuario INT, @codArea INT
)
AS
BEGIN 
	DECLARE @codEstadoInactivoUsuarioArea INT
	DECLARE @codEstadoActivoUsuarioArea INT
	DECLARE @codUltimaArea INT

	SELECT @codEstadoInactivoUsuarioArea = codEstado FROM Estado WHERE descripcion = 'i'
	SELECT @codEstadoActivoUsuarioArea = codEstado FROM Estado WHERE descripcion = 'a'

	SELECT @codUltimaArea = codUsuarioArea FROM UsuarioArea WHERE codUsuario= @codUsuario and codArea = @codArea

	UPDATE UsuarioArea SET codEstado = @codEstadoInactivoUsuarioArea WHERE codUsuarioArea = @codUsuarioArea;

	IF @codUltimaArea IS NOT NULL
	BEGIN		
		UPDATE UsuarioArea SET codEstado = @codEstadoActivoUsuarioArea WHERE codUsuarioArea = @codUltimaArea;
	END
	ELSE 
	BEGIN		
		INSERT INTO UsuarioArea(codUsuario, codArea, codEstado) VALUES(@codUsuario, @codArea, @codEstadoActivoUsuarioArea)
	END
END
GO


CREATE PROCEDURE sp_deshabilitarUsuario(
	@codUsuarioArea INT
)
AS 
BEGIN
	DECLARE @codEstadoPausa INT

	SELECT @codEstadoPausa = codEstado FROM Estado WHERE descripcion = 'p';

	UPDATE UsuarioArea SET codEstado = @codEstadoPausa
	where codUsuarioArea = @codUsuarioArea
END
GO

CREATE PROCEDURE sp_habilitarUsuario(
	@codUsuarioArea INT
)
AS 
BEGIN
	DECLARE @codEstadoActivo INT
	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	UPDATE UsuarioArea SET codEstado = @codEstadoActivo
	where codUsuarioArea = @codUsuarioArea
END
GO

-- registrar un envio
CREATE PROCEDURE sp_registrarEnvio(
	@codRecepcion INT NULL, @numDocumento VARCHAR(20), @folios INT, @codIndicacion INT, 
	@observacion VARCHAR(300) NULL, @codUsuarioAreaDestino INT,@codUsuarioAreaEnvio INT, @fechaEnvio DATE, @horaEnvio TIME
)
AS
BEGIN
	DECLARE @codEstadoActivo INT;
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';
	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	INSERT INTO Envio 
		(fechaEnvio, horaEnvio, folios, observaciones, codEstado, codIndicacion, NumDocumento, codUsuarioEnvio, codUsuarioDestino)
    VALUES (@fechaEnvio, @horaEnvio, @folios, @observacion, @codEstadoActivo, @codIndicacion, @numDocumento, @codUsuarioAreaEnvio, @codUsuarioAreaDestino)

	DECLARE @codEnvioInsert INT;
    SET @codEnvioInsert = SCOPE_IDENTITY();

	UPDATE Documento SET codEstado = @codEstadoActivo where NumDocumento = @numDocumento

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

-- registrar documento
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

-- finalizar el seguimiento de un documento
CREATE PROCEDURE sp_finalizarSeguimientoDocumento(
	@numDocumento VARCHAR(20)
)
AS
BEGIN
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	UPDATE Documento SET codEstado = @codEstadoInactivo WHERE NumDocumento = @numDocumento
END
GO


-- confirmar recepcion de un documento
CREATE PROCEDURE sp_confirmarRecepcion(
	@codRecepcion INT, @horaRecepcion TIME, @fechaRecepcion DATE
)
AS
BEGIN
	DECLARE @codEstadoActivo INT;

	SELECT @codEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

	UPDATE Recepcion SET codEstado = @codEstadoActivo, horaRecepcion = @horaRecepcion, fechaRecepcion = @fechaRecepcion 
	WHERE codRecepcion = @codRecepcion
END
GO



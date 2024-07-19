-------------PROCEDIMIENTOS ALMACENADOS DEL SISTEMA

-------- Modulo Documentos

-- sp para listar los documentos registrados
CREATE PROCEDURE sp_listarDocumentos(
	@codAreaUsuario INT = NULL, @numDocumento VARCHAR(20) = NULL
)
AS 
BEGIN
	SET NOCOUNT ON;

	SELECT d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
                CONCAT(p.nombres ,' ',p.apellidos) 'usuario registrador', a.descripcion 'area', e.descripcion 'estado'
                from Documento d
                inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
                inner join UsuarioArea ua on d.codUsuario = ua.codUsuarioArea
				inner join Area a on ua.codArea  = a.codArea
                inner join Usuario u on ua.codUsuario = u.codUsuario
                inner join Persona p on u.codPersona = p.codPersona
                inner join Estado e on d.codEstado = e.codEstado
                where 
				(@codAreaUsuario IS NULL OR ua.codUsuarioArea = @codAreaUsuario) 
				AND 
				(@numDocumento IS NULL OR d.NumDocumento = @numDocumento)
                order by d.fechaRegistro DESC, d.horaRegistro DESC
END
GO

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
				INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
				INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
				INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
				-- �rea origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- �rea destino 
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

-- listar los documentos recepcionados por un usuario
CREATE PROCEDURE sp_listarDocumentosRecepcionados(
	@codUsuarioArea INT
)
AS
BEGIN
		DECLARE @CodEstadoActivo INT

		SELECT @CodEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

		SELECT 
		r.codRecepcion,
		e.codEnvio,
		LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
		e.fechaEnvio,
		e.folios, 
		e.observaciones,
		er.descripcion 'estado recepcion',
		e.NumDocumento,
		td.descripcion 'tipo documento',
		CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
		ae.descripcion 'area origen',
		CONCAT(pd.nombres, pd.apellidos) 'usuario destino', 
		ad.descripcion 'area destino',
		ed.descripcion 'estado documento'
		FROM Recepcion r
		INNER JOIN Envio e ON r.codEnvio = e.codEnvio
		INNER JOIN Estado er ON r.codEstado = er.codEstado
		INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
		INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
		-- Usuario origen
		INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
		INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
		INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
		-- �rea origen 
		INNER JOIN Area ae ON uae.codArea = ae.codArea
		-- Usuario destino
		INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
		INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
		INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
		-- �rea destino 
		INNER JOIN Area ad ON uad.codArea = ad.codArea
		-- Estado Documento
		INNER JOIN Estado ed ON d.codEstado = ed.codEstado
		WHERE r.codUsuarioRecepcion = @codUsuarioArea AND r.codEstado = @CodEstadoActivo
		ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
END
GO
-----------------------------------------------------------------------------------------

-- listar los documentos pendientes de recepcion por un usuario
CREATE PROCEDURE sp_listarDocumentosPendientesRecepcion(
	@codUsuarioArea INT
)
AS
BEGIN
	DECLARE @CodEstadoInactivo INT
	SELECT @CodEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	SELECT 
        r.codRecepcion,
        e.codEnvio,
        LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
        e.fechaEnvio, 
        e.folios, 
        e.observaciones,
        er.descripcion 'estado recepcion', 
        e.NumDocumento, 
        td.descripcion 'tipo documento', 
        CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
        ae.descripcion 'area origen', 
        CONCAT(pd.nombres, pd.apellidos) 'usuario destino',
        ad.descripcion 'area destino',
		ed.descripcion 'estado documento'
        FROM Recepcion r
        INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
        INNER JOIN Estado er ON r.codEstado = er.codEstado
        INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
        INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
        INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
        INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario 
        INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
        INNER JOIN Area ae ON uae.codArea = ae.codArea 
        INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea 
        INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario 
        INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
        INNER JOIN Area ad ON uad.codArea = ad.codArea				
		INNER JOIN Estado ed ON d.codEstado = ed.codEstado
        WHERE r.codUsuarioRecepcion = @codUsuarioArea AND r.codEstado = @CodEstadoInactivo
        ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
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
				INNER JOIN Estado ee ON r.codEstado = ee.codEstado
				-- �rea origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- �rea destino 
				INNER JOIN Area ad ON uad.codArea = ad.codArea
				-- Estado de la recepcion
				INNER JOIN Estado er ON r.codEstado = er.codEstado			
				where e.codEnvio = @codEnvio
END
GO

-----------------------------------------------------------------------------------------

-- cancelar envio
CREATE PROCEDURE sp_cancelarRecepcion(
	@codRecepcion INT
)
AS BEGIN
	DECLARE @codEstadoInactivo INT;

	SELECT @codEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	UPDATE Recepcion SET codEstado = @codEstadoInactivo where codRecepcion = @codRecepcion;
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

------------------------------------- REPORTES ---------------------------------------

-- Obtener documentos por area
ALTER PROCEDURE sp_reporteDocumentosPorArea
    @codArea INT = NULL, @numDocumento VARCHAR(20) = NULL
AS
BEGIN
    -- Obtener el �ltimo env�o de cada documento
    WITH UltimosEnvios AS (
        SELECT
            NumDocumento,
            MAX(codEnvio) AS UltimoCodEnvio
        FROM Envio
        GROUP BY NumDocumento
    )
    -- Seleccionar los documentos que est�n en el �rea especificada o en todas las �reas si @codArea es NULL
    SELECT
		e.codEnvio,
        d.NumDocumento,
        d.asunto,
        e.folios,
		CONCAT(pd.nombres, ' ', pd.apellidos) AS 'usuario',
		a.descripcion AS 'area',
        td.descripcion AS 'tipoDocumento',
        es.descripcion AS 'estadoDocumento',
		er.descripcion AS 'estadoRecepcion',
        ua.codArea
    FROM
        Documento d
    INNER JOIN
        UltimosEnvios ue ON d.NumDocumento = ue.NumDocumento
    INNER JOIN
        Envio e ON ue.UltimoCodEnvio = e.codEnvio
    INNER JOIN
        UsuarioArea ua ON e.codUsuarioDestino = ua.codUsuarioArea
		INNER JOIN UsuarioArea uae on e.codUsuarioDestino = uae.codUsuarioArea
		INNER JOIN Usuario ud on uae.codUsuario = ud.codUsuario
		INNER JOIN Persona pd on ud.codPersona = pd.codPersona
    INNER JOIN
        Area a ON ua.codArea = a.codArea
    INNER JOIN
        TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
    INNER JOIN
        Estado es ON d.codEstado = es.codEstado
		INNER JOIN Recepcion r on e.codEnvio = r.codEnvio
		INNER JOIN Estado er on r.codEstado = er.codEstado
    WHERE
        (@codArea IS NULL OR ua.codArea = @codArea) AND (@numDocumento IS NULL OR e.NumDocumento = @numDocumento);
END
GO


-- Obtener documentos por usuario
CREATE PROCEDURE sp_reporteDocumentosPorUsuario
    @codArea INT = NULL, @numDocumento VARCHAR(20) = NULL, @codUsuarioAreaDestino INT = NULL
AS
BEGIN
    -- Obtener el �ltimo env�o de cada documento
    WITH UltimosEnvios AS (
        SELECT
            NumDocumento,
            MAX(codEnvio) AS UltimoCodEnvio
        FROM Envio
        GROUP BY NumDocumento
    )
    -- Seleccionar los documentos que est�n en el �rea especificada o en todas las �reas si @codArea es NULL
    SELECT
		e.codEnvio,
        d.NumDocumento,
        d.asunto,
        e.folios,
		CONCAT(pd.nombres, ' ', pd.apellidos) AS 'usuario',
		a.descripcion AS 'area',
        td.descripcion AS 'tipoDocumento',
        es.descripcion AS 'estadoDocumento',
		er.descripcion AS 'estadoRecepcion',
        ua.codArea
    FROM
        Documento d
    INNER JOIN
        UltimosEnvios ue ON d.NumDocumento = ue.NumDocumento
    INNER JOIN
        Envio e ON ue.UltimoCodEnvio = e.codEnvio
    INNER JOIN
        UsuarioArea ua ON e.codUsuarioDestino = ua.codUsuarioArea
		INNER JOIN UsuarioArea uae on e.codUsuarioDestino = uae.codUsuarioArea
		INNER JOIN Usuario ud on uae.codUsuario = ud.codUsuario
		INNER JOIN Persona pd on ud.codPersona = pd.codPersona
    INNER JOIN
        Area a ON ua.codArea = a.codArea
    INNER JOIN
        TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
    INNER JOIN
        Estado es ON d.codEstado = es.codEstado
		INNER JOIN Recepcion r on e.codEnvio = r.codEnvio
		INNER JOIN Estado er on r.codEstado = er.codEstado
    WHERE
        (@codArea IS NULL OR ua.codArea = @codArea) 
		AND (@numDocumento IS NULL OR e.NumDocumento = @numDocumento) 
		AND (@codUsuarioAreaDestino IS NULL OR uae.codUsuarioArea = @codUsuarioAreaDestino);
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
END;
-- generar reporte de los documentos recepcionados por un usuario por fecha
CREATE PROCEDURE sp_reporteDocumentosRecepcionados(
	@codUsuarioArea INT, 
	@pagina INT = 1,
    @registrosPorPagina INT = 10,
	@fechaInicio DATE = NULL,
	@fechaFin DATE = NULL,
	@numDocumento VARCHAR(20) = ''
)
AS
BEGIN
		DECLARE @CodEstadoActivo INT

		SELECT @CodEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

		IF @pagina IS NULL AND @registrosPorPagina IS NULL
		BEGIN
			SELECT 
			r.codRecepcion,
			e.codEnvio,
			LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
			e.fechaEnvio,
			r.fechaRecepcion,
			LEFT(CONVERT(VARCHAR, r.horaRecepcion, 108), 5) AS 'hora recepcion',
			e.folios, 
			e.observaciones,
			er.descripcion 'estado recepcion',
			e.NumDocumento,
			d.asunto,
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
			-- 햞ea origen 
			INNER JOIN Area ae ON uae.codArea = ae.codArea
			-- Usuario destino
			INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
			INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
			INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
			-- 햞ea destino 
			INNER JOIN Area ad ON uad.codArea = ad.codArea
			-- Estado Documento
			INNER JOIN Estado ed ON d.codEstado = ed.codEstado
			WHERE r.codUsuarioRecepcion = @codUsuarioArea AND r.codEstado = @CodEstadoActivo
			AND (@fechaInicio IS NULL OR r.fechaRecepcion >= @fechaInicio)
			AND (@fechaFin IS NULL OR r.fechaRecepcion <= @fechaFin)
			AND e.NumDocumento LIKE '%'+@numDocumento+'%'
			ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC			
		END
		ELSE
		BEGIN
			DECLARE @offset INT;
			SET @offset = (@pagina - 1) * @registrosPorPagina;

			SELECT 
		r.codRecepcion,
		e.codEnvio,
		LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
		e.fechaEnvio,
		r.fechaRecepcion,
		LEFT(CONVERT(VARCHAR, r.horaRecepcion, 108), 5) AS 'hora recepcion',
		e.folios, 
		e.observaciones,
		er.descripcion 'estado recepcion',
		e.NumDocumento,
		d.asunto,
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
		-- 햞ea origen 
		INNER JOIN Area ae ON uae.codArea = ae.codArea
		-- Usuario destino
		INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
		INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
		INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
		-- 햞ea destino 
		INNER JOIN Area ad ON uad.codArea = ad.codArea
		-- Estado Documento
		INNER JOIN Estado ed ON d.codEstado = ed.codEstado
		WHERE r.codUsuarioRecepcion = @codUsuarioArea AND r.codEstado = @CodEstadoActivo
		AND (@fechaInicio IS NULL OR r.fechaRecepcion >= @fechaInicio)
        AND (@fechaFin IS NULL OR r.fechaRecepcion <= @fechaFin)
		AND e.NumDocumento LIKE '%'+@numDocumento+'%'
		ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
		OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
		END
END
GO
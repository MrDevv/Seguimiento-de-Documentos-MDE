-- Obtener documentos por usuario
CREATE PROCEDURE sp_reporteDocumentosPorUsuario
    @codArea INT = NULL, 
	@numDocumento VARCHAR(20) = NULL, 
	@codUsuarioAreaDestino INT = NULL,
	@pagina INT = NULL,
    @registrosPorPagina INT = NULL
AS
BEGIN
	IF @pagina IS NULL AND @registrosPorPagina IS NULL
	BEGIN    
		WITH UltimosEnvios AS (
			SELECT
				NumDocumento,
				MAX(codEnvio) AS UltimoCodEnvio
			FROM Envio
			GROUP BY NumDocumento
		)
		-- Seleccionar los documentos que están en el área especificada o en todas las áreas si @codArea es NULL
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
			AND (@codUsuarioAreaDestino IS NULL OR uae.codUsuarioArea = @codUsuarioAreaDestino)
		ORDER BY pd.nombres
	END
	ELSE
	BEGIN
		DECLARE @offset INT;
		SET @offset = (@pagina - 1) * @registrosPorPagina;

		WITH UltimosEnvios AS (
		SELECT
			NumDocumento,
			MAX(codEnvio) AS UltimoCodEnvio
		FROM Envio
		GROUP BY NumDocumento
		)
		-- Seleccionar los documentos que están en el área especificada o en todas las áreas si @codArea es NULL
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
			AND (@codUsuarioAreaDestino IS NULL OR uae.codUsuarioArea = @codUsuarioAreaDestino)
		ORDER BY pd.nombres
		OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
	END
END
GO
-- generar reporte de los documentos recepcionados por un usuario por fecha
CREATE PROCEDURE sp_reporteDocumentosEnviados(
	@codUsuarioArea INT, 
	@pagina INT = 1,
    @registrosPorPagina INT = 10,
	@fechaInicio DATE = NULL,
	@fechaFin DATE = NULL,
	@numDocumento VARCHAR(20) = ''
)
AS
BEGIN
		IF @pagina IS NULL AND @registrosPorPagina IS NULL
		BEGIN
			SELECT e.codEnvio,
            LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
            e.fechaEnvio, 
            e.folios, 
            e.observaciones, 
            d.NumDocumento, 
			d.asunto,
            td.descripcion 'tipo documento', 
            CONCAT(pd.nombres, ' ',pd.apellidos) 'usuario destino', 
            ad.descripcion 'area destino', 
            er.descripcion 'estado recepcion', 
            ed.descripcion 'estado documento' 
            from Recepcion r 
            INNER JOIN Envio e on r.codEnvio = e.codEnvio 
            INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento 
            INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento 
            INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea 
            INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario 
            INNER JOIN Persona pd ON ud.codPersona = pd.codPersona 
            INNER JOIN Area ad ON uad.codArea = ad.codArea 
            INNER JOIN Estado er ON r.codEstado = er.codEstado 
            INNER JOIN Estado ed ON d.codEstado = ed.codEstado 
            WHERE e.codUsuarioEnvio =  @codUsuarioArea
			AND (@fechaInicio IS NULL OR e.fechaEnvio >= @fechaInicio)
			AND (@fechaFin IS NULL OR e.fechaEnvio <= @fechaFin)
			AND e.NumDocumento LIKE '%'+@numDocumento+'%'
			ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC	
		END
		ELSE
		BEGIN
			DECLARE @offset INT;
			SET @offset = (@pagina - 1) * @registrosPorPagina;

			SELECT e.codEnvio,
            LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
            e.fechaEnvio, 
            e.folios, 
            e.observaciones, 
            d.NumDocumento, 
			d.asunto,
            td.descripcion 'tipo documento', 
            CONCAT(pd.nombres, ' ',pd.apellidos) 'usuario destino', 
            ad.descripcion 'area destino', 
            er.descripcion 'estado recepcion', 
            ed.descripcion 'estado documento' 
            from Recepcion r 
            INNER JOIN Envio e on r.codEnvio = e.codEnvio 
            INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento 
            INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento 
            INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea 
            INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario 
            INNER JOIN Persona pd ON ud.codPersona = pd.codPersona 
            INNER JOIN Area ad ON uad.codArea = ad.codArea 
            INNER JOIN Estado er ON r.codEstado = er.codEstado 
            INNER JOIN Estado ed ON d.codEstado = ed.codEstado 
            WHERE e.codUsuarioEnvio =  @codUsuarioArea
			AND (@fechaInicio IS NULL OR e.fechaEnvio >= @fechaInicio)
			AND (@fechaFin IS NULL OR e.fechaEnvio <= @fechaFin)
			AND e.NumDocumento LIKE '%'+@numDocumento+'%'
			ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
			OFFSET @offset ROWS
			FETCH NEXT @registrosPorPagina ROWS ONLY;	
		END
END
GO
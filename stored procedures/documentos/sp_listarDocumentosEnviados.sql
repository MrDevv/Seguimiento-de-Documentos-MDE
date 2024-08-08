-- listar los documentos enviados por un usuario
CREATE PROCEDURE sp_listarDocumentosEnviados(
	@codUsuarioArea INT, @codArea INT = NULL
)
AS
BEGIN
		DECLARE @CodEstadoActivo INT

		SELECT @CodEstadoActivo = codEstado FROM Estado WHERE descripcion = 'a';

		IF @codArea IS NULL
		BEGIN
			SELECT e.codEnvio,
            LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
            e.fechaEnvio, 
            e.folios, 
            e.observaciones, 
            d.NumDocumento, 
            td.descripcion 'tipo documento', 
            CONCAT(pd.nombres, ' ',pd.apellidos) 'usuario destino', 
            ad.descripcion 'area destino', 
            er.descripcion 'estado recepcion', 
            ed.descripcion 'estado documento' 
            from Recepcion r 
            inner join Envio e on r.codEnvio = e.codEnvio 
            INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento 
            INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento 
            INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea 
            INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario 
            INNER JOIN Persona pd ON ud.codPersona = pd.codPersona 
            INNER JOIN Area ad ON uad.codArea = ad.codArea 
            INNER JOIN Estado er ON r.codEstado = er.codEstado 
            INNER JOIN Estado ed ON d.codEstado = ed.codEstado 
            WHERE e.codUsuarioEnvio =  @codUsuarioArea
			ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
		END
		ELSE
		BEGIN
			SELECT e.codEnvio,
				LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
				e.fechaEnvio, 
				e.folios, 
				e.observaciones, 
				d.NumDocumento, 
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
				INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuarioArea
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				INNER JOIN Estado er ON r.codEstado = er.codEstado 
				INNER JOIN Estado ed ON d.codEstado = ed.codEstado 				
				WHERE ae.codArea = @codArea
				ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
		END
END
GO
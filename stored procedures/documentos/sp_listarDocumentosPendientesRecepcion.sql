-- procedimiento almacenado para listar los documentos pendientes de recepcion por un usuario
CREATE PROCEDURE sp_listarDocumentosPendientesRecepcion(
	@codUsuarioArea INT,
	@codArea INT = NULL,
	@pagina INT = 1,
    @registrosPorPagina INT = 10
)
AS
BEGIN
	DECLARE @CodEstadoInactivo INT
	SELECT @CodEstadoInactivo = codEstado FROM Estado WHERE descripcion = 'i';

	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;
	
	IF @codArea IS NULL
	BEGIN
		SELECT 
			r.codRecepcion,
			e.codEnvio,
			LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
			e.fechaEnvio, 
			e.folios, 
			e.observaciones,
			er.descripcion 'estado recepcion', 
			d.NumDocumento, 
			td.descripcion 'tipo documento', 
			CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
			ae.descripcion 'area origen', 
			CONCAT(pd.nombres, pd.apellidos) 'usuario destino',
			ad.descripcion 'area destino',
			ed.descripcion 'estado documento'
			FROM Recepcion r
			INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
			INNER JOIN Estado er ON r.codEstado = er.codEstado
			INNER JOIN Documento d ON e.numRegistro = d.numRegistro
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
			OFFSET @offset ROWS
			FETCH NEXT @registrosPorPagina ROWS ONLY;
		END
		ELSE
		BEGIN
			SELECT 
			r.codRecepcion,
			e.codEnvio,
			LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
			e.fechaEnvio, 
			e.folios, 
			e.observaciones,
			er.descripcion 'estado recepcion', 
			d.NumDocumento, 
			td.descripcion 'tipo documento', 
			CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
			ae.descripcion 'area origen', 
			CONCAT(pd.nombres, pd.apellidos) 'usuario destino',
			ad.descripcion 'area destino',
			ed.descripcion 'estado documento'
			FROM Recepcion r
			INNER JOIN Envio e ON r.codEnvio = e.codEnvio 
			INNER JOIN Estado er ON r.codEstado = er.codEstado
			INNER JOIN Documento d ON e.numRegistro = d.numRegistro
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
			WHERE uad.codArea = @codArea AND r.codEstado = @CodEstadoInactivo
			ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC
			OFFSET @offset ROWS
			FETCH NEXT @registrosPorPagina ROWS ONLY;
		END
END
GO
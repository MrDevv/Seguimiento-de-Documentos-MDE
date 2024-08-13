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
				-- Área origen 
				INNER JOIN Area ae ON uae.codArea = ae.codArea
				-- Usuario destino
				INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuarioArea
				INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
				INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
				-- Área destino 
				INNER JOIN Area ad ON uad.codArea = ad.codArea
				-- Estado de la recepcion
				INNER JOIN Estado er ON r.codEstado = er.codEstado			
				where e.codEnvio = @codEnvio
END
GO
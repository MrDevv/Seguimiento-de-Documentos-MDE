-- procedimiento almacenado para listar los documentos registrados
CREATE PROCEDURE sp_listarDocumentos(
	@codAreaUsuario INT = NULL, 
	@numDocumento VARCHAR(20), 
	@codArea INT = NULL,
	@pagina INT,
    @registrosPorPagina INT
)
AS 
BEGIN
	SET NOCOUNT ON;

	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;

	IF @codArea IS NULL
	BEGIN
		SELECT d.NumDocumento, tp.codTipoDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
					CONCAT(p.nombres ,' ',p.apellidos) 'usuario registrador', a.codArea ,a.descripcion 'area', e.descripcion 'estado'
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
					d.NumDocumento LIKE '%'+@numDocumento+'%'
					order by d.fechaRegistro DESC, d.horaRegistro DESC
					OFFSET @offset ROWS
					FETCH NEXT @registrosPorPagina ROWS ONLY;
	END
	ELSE
	BEGIN
			SELECT d.NumDocumento, tp.codTipoDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
					CONCAT(p.nombres ,' ',p.apellidos) 'usuario registrador', a.codArea ,a.descripcion 'area', e.descripcion 'estado'
					from Documento d
					inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
					inner join UsuarioArea ua on d.codUsuario = ua.codUsuarioArea
					inner join Area a on ua.codArea  = a.codArea
					inner join Usuario u on ua.codUsuario = u.codUsuario
					inner join Persona p on u.codPersona = p.codPersona
					inner join Estado e on d.codEstado = e.codEstado
					where 
					(ua.codArea  = @codArea) 
					AND 
					d.NumDocumento LIKE '%'+@numDocumento+'%'				
					order by d.fechaRegistro DESC, d.horaRegistro DESC
					OFFSET @offset ROWS
					FETCH NEXT @registrosPorPagina ROWS ONLY;
	END
END
GO

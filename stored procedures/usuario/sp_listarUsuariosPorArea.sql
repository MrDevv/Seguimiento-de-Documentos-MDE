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
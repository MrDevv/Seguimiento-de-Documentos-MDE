CREATE PROCEDURE sp_obtenerDatosUsuarioLogeado(
	@codUsuarioArea INT
)
AS
BEGIN
	SELECT u.codUsuario, p.codPersona, p.nombres, p.apellidos, u.nombreUsuario ,p.dni, p.telefono, r.descripcion 'rol', a.descripcion 'area' 
		FROM Usuario u 
		INNER JOIN Persona p ON u.codPersona = p.codPersona
		INNER JOIN Rol r ON u.codRol = r.codRol
		INNER JOIN UsuarioArea ua ON u.codUsuario = ua.codUsuario
		INNER JOIN Area a ON ua.codArea = a.codArea
		WHERE ua.codUsuarioArea = @codUsuarioArea
END
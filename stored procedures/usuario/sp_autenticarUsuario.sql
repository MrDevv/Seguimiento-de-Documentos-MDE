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
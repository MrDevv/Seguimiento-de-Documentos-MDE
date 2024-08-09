CREATE PROCEDURE sp_totalUsuarios(
	@estado CHAR NULL, @apellidos VARCHAR(50)
)
AS
BEGIN
	IF @estado IS NULL
	BEGIN	
		SELECT COUNT(ua.codUsuarioArea) 'total'
		FROM UsuarioArea ua 
		INNER JOIN Estado e ON ua.codEstado = e.codEstado 
		INNER JOIN Usuario u ON ua.codUsuario = u.codUsuario 
		INNER JOIN Persona p ON u.codPersona = p.codPersona 
		WHERE (e.descripcion = 'a' OR e.descripcion = 'p')
		AND p.apellidos LIKE '%' + @apellidos + '%' 
	END
	ELSE
	BEGIN
		SELECT COUNT(ua.codUsuarioArea) 'total'
		FROM UsuarioArea ua 
		INNER JOIN Estado e ON ua.codEstado = e.codEstado 	
		INNER JOIN Usuario u ON ua.codUsuario = u.codUsuario 
		INNER JOIN Persona p ON u.codPersona = p.codPersona 
		WHERE e.descripcion = @estado
		AND p.apellidos LIKE '%' + @apellidos + '%' 
	END
END
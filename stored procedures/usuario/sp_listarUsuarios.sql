CREATE PROCEDURE sp_listarUsuarios(
    @codArea INT NULL,
	@estado CHAR NULL,
	@apellidos VARCHAR(20),
    @pagina INT,
    @registrosPorPagina INT
)
AS
BEGIN
	-- Calcula el número de registros a omitir basado en la página actual
	DECLARE @offset INT;
	SET @offset = (@pagina - 1) * @registrosPorPagina;

	IF @estado IS NULL
	BEGIN	
		SELECT ua.codUsuarioArea, ua.codArea, u.codPersona, u.codUsuario, u.codRol, 
			   u.nombreUsuario AS 'usuario', e.descripcion AS 'estado', p.nombres, 
			   p.apellidos, p.dni, p.telefono, a.descripcion AS 'area', 
			   r.descripcion AS 'rol' 
		FROM UsuarioArea ua 
		INNER JOIN Usuario u ON ua.codUsuario = u.codUsuario 
		INNER JOIN Persona p ON u.codPersona = p.codPersona 
		INNER JOIN Area a ON ua.codArea = a.codArea 
		INNER JOIN Estado e ON ua.codEstado = e.codEstado 
		INNER JOIN Rol r ON u.codRol = r.codRol 
		WHERE p.apellidos LIKE '%' + @apellidos + '%' 
		AND (e.descripcion = 'a' OR e.descripcion = 'p')
		AND (@codArea IS NULL OR ua.codArea = @codArea)
		ORDER BY ua.codUsuarioArea  -- Ordena los resultados para la paginación
		OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
	END
	ELSE 
	BEGIN
		SELECT ua.codUsuarioArea, ua.codArea, u.codPersona, u.codUsuario, u.codRol, 
			   u.nombreUsuario AS 'usuario', e.descripcion AS 'estado', p.nombres, 
			   p.apellidos, p.dni, p.telefono, a.descripcion AS 'area', 
			   r.descripcion AS 'rol' 
		FROM UsuarioArea ua 
		INNER JOIN Usuario u ON ua.codUsuario = u.codUsuario 
		INNER JOIN Persona p ON u.codPersona = p.codPersona 
		INNER JOIN Area a ON ua.codArea = a.codArea 
		INNER JOIN Estado e ON ua.codEstado = e.codEstado 
		INNER JOIN Rol r ON u.codRol = r.codRol 
		WHERE p.apellidos LIKE '%' + @apellidos + '%' 
		AND e.descripcion = @estado
		AND (@codArea IS NULL OR ua.codArea = @codArea)
		ORDER BY ua.codUsuarioArea  -- Ordena los resultados para la paginación
		OFFSET @offset ROWS
		FETCH NEXT @registrosPorPagina ROWS ONLY;
	END
END
GO

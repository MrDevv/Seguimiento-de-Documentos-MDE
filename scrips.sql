
select * from Documento


------------------- CONSULTAS AVANZADAS DEL SISTEMA -------------------

----- Modulo de DOCUMENTOS

-- buscar si un ya documento existe
select * from Documento where NumDocumento = '9012'



----- Modulo de USUARIOS

-- listar usuarios del sistema
select u.codUsuario, u.nombreUsuario 'usuario', e.descripcion 'estado',
p.nombres, p.apellidos, p.dni, p.telefono, a.descripcion 'area',
r.descripcion 'rol'
from UsuarioArea ua
inner join usuario u on ua.codUsuario = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona
inner join area a on ua.codArea = a.codArea
inner join Estado e on u.codEstado = e.codEstado
inner join rol r on u.codRol = r.codRol


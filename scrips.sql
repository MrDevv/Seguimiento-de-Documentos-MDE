
select * from Documento


------------------- CONSULTAS AVANZADAS DEL SISTEMA -------------------

----- Modulo de DOCUMENTOS

-- listar todos los documentos
select d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
CONCAT(p.nombres ,p.apellidos) 'usuario registrador', e.descripcion 'estado'
from Documento d
inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
inner join UsuarioArea ua on d.codUsuario = ua.codUsuario
inner join Usuario u on ua.codEstado = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona
inner join Estado e on d.codEstado = e.codEstado;


-- buscar un documento por su numero
select d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro,
CONCAT(p.nombres ,p.apellidos) 'usuario registrador', e.descripcion 'estado'
from Documento d
inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
inner join UsuarioArea ua on d.codUsuario = ua.codUsuario
inner join Usuario u on ua.codEstado = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona
inner join Estado e on d.codEstado = e.codEstado
where d.NumDocumento = '9012'

-- actualizar un documento
update Documento set asunto = 'asunto ac', folios = 3, codTipoDocumento = 3
where NumDocumento = '9012'



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


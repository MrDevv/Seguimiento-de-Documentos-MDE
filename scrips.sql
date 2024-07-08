
select * from Documento
select * from Estado

insert into Estado(descripcion) values('n');

update estado set descripcion = 'a' where codEstado = 2

insert into Persona (nombres, apellidos, telefono, dni, codEstado)
values ('Julio', 'Rojas', '949839321', '78592323', 2)

select * from Persona
select * from Usuario
select * from UsuarioArea

insert into Usuario (nombreUsuario, password, codRol, codPersona, codEstado)
values ('jrojas', '1234', 1, 3, 2)

insert into UsuarioArea (codUsuario, codArea, codEstado)
values(3, 1, 2)

select * from Movimiento


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
inner join Estado e on d.codEstado = e.codEstado
order by d.fechaRegistro DESC;


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

-- actualizar el estado al documento para finalizar su seguimiento
update Documento set codEstado = 1 where NumDocumento = '9012';

-- listar documentos pendientes de recepcion para un usuario y una area determinada
SELECT e.codEnvio, 
       LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
	   e.fechaEnvio,
       e.folios, 
       e.observaciones,
       es.descripcion 'estado envio', 
       d.NumDocumento, 
       td.descripcion 'tipo documento',
       CONCAT(pe.nombres, pe.apellidos) 'usuario origen', 
       ae.descripcion 'area origen',
       CONCAT(pe.nombres, pe.apellidos) 'usuario destino', 
       ad.descripcion 'area destino'
FROM Envio e
-- Datos del estado
INNER JOIN Estado es ON e.codEstado = es.codEstado
-- Datos del documento
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
-- Datos del tipo documento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario origen
INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
-- 햞ea origen 
INNER JOIN Area ae ON uae.codArea = ae.codArea
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- 햞ea destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
where ud.codUsuario = 2 and ad.codArea = 2

-- listar documentos recepcionados de un usuario y una area determinada
SELECT e.codEnvio, 
       LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
	   e.fechaEnvio,
       e.folios, 
       e.observaciones,
       es.descripcion 'estado envio', 
       d.NumDocumento, 
       td.descripcion 'tipo documento',
       CONCAT(pe.nombres, pe.apellidos) 'usuario origen', 
       ae.descripcion 'area origen',
       CONCAT(pe.nombres, pe.apellidos) 'usuario destino', 
       ad.descripcion 'area destino'
FROM Envio e
-- Datos del estado
INNER JOIN Estado es ON e.codEstado = es.codEstado
-- Datos del documento
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
-- Datos del tipo documento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario origen
INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
-- 햞ea origen 
INNER JOIN Area ae ON uae.codArea = ae.codArea
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- 햞ea destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
where ue.codUsuario = 2 and ae.codArea = 2 and e.codEstado = 2

---- Modulo de AREAS
-- listar todos los usuarios de una area determinada excepto el usuario logeado
select ua.codUsuarioArea, concat(p.nombres, p.apellidos) 'usuario' 
from UsuarioArea ua 
inner join Area a on ua.codArea = a.codArea
inner join Usuario u on ua.codUsuario = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona 
where a.codArea = 1 and ua.codUsuarioArea != 4

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
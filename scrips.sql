----------- INSERT DE DATOS INICIALES DEL SISTEMA

-- Estados del sistema
insert into Estado(descripcion) values('n'), ('a'), ('i'), ('e');


-- Roles del sistema
insert into Rol(descripcion) values('administrador'), ('usuario');

-- Movimientos del sistema
insert into Movimiento(descripcion) values('deducción');

-- Areas del Sistema
insert into Area(descripcion) values('rentas'),('recursos humanos'),('GAT');

-- Tipo Documento
insert into TipoDocumento(descripcion) values('memorando'),('carta'),('oficio'),('denuncia')

-- Personas
insert into Persona (nombres, apellidos, telefono, dni, codEstado)
values 
('Larri Rodrigo', 'Estrada Leon', '949839321', '78592323', 2),
('Miguel Angel', 'Vega Perez', '958443234', '74293456', 2);


insert into Usuario (nombreUsuario, password, codRol, codPersona, codEstado)
values 
('lestradal', 'admin123', 1, 1, 2),
('mvegap', 'admin123', 1, 2, 2)

insert into UsuarioArea (codUsuario, codArea, codEstado)
values
(1, 1, 2),
(2, 2, 2)













------------------- CONSULTAS AVANZADAS DEL SISTEMA -------------------

----- Modulo de DOCUMENTOS

-- listar todos los documentos
select d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro, d.horaRegistro,
CONCAT(p.nombres ,p.apellidos) 'usuario registrador', e.descripcion 'estado'
from Documento d
inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento
inner join UsuarioArea ua on d.codUsuario = ua.codUsuario
inner join Usuario u on ua.codUsuario = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona
inner join Estado e on d.codEstado = e.codEstado
where ua.codUsuario LIKE '%3%'
order by d.fechaRegistro, d.horaRegistro DESC;


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
SELECT 
	r.codRecepcion,
	e.codEnvio,
	LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
	e.fechaEnvio,
    e.folios, 
    e.observaciones,
	er.descripcion 'estado recepcion',
	e.NumDocumento,
	td.descripcion 'tipo documento',
	CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
    ae.descripcion 'area origen',
	CONCAT(pd.nombres, pd.apellidos) 'usuario destino', 
    ad.descripcion 'area destino'
FROM Recepcion r
INNER JOIN Envio e ON r.codEnvio = e.codEnvio
INNER JOIN Estado er ON r.codEstado = er.codEstado
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario origen
INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
-- Área origen 
INNER JOIN Area ae ON uae.codArea = ae.codArea
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- Área destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
WHERE r.codUsuarioRecepcion LIKE '%%' AND r.codEstado = 3


select * from Usuario
select * from Estado

-- listar documentos recepcionados de un usuario y una area determinada
SELECT 
	r.codRecepcion,
	e.codEnvio,
	LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio',
	e.fechaEnvio,
    e.folios, 
    e.observaciones,
	er.descripcion 'estado recepcion',
	e.NumDocumento,
	td.descripcion 'tipo documento',
	CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
    ae.descripcion 'area origen',
	CONCAT(pd.nombres, pd.apellidos) 'usuario destino', 
    ad.descripcion 'area destino'
FROM Recepcion r
INNER JOIN Envio e ON r.codEnvio = e.codEnvio
INNER JOIN Estado er ON r.codEstado = er.codEstado
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario origen
INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
-- Área origen 
INNER JOIN Area ae ON uae.codArea = ae.codArea
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- Área destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
WHERE r.codUsuarioRecepcion LIKE '%2%' AND r.codEstado = 2

-- obtener documentos enviados por un usuario con estado pendiente de recepcion
select e.codEnvio, 
       LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
	   e.fechaEnvio,
       e.folios, 
       e.observaciones,
	   d.NumDocumento, 
       td.descripcion 'tipo documento',
	   CONCAT(pd.nombres, ' ' ,pd.apellidos) 'usuario destino', 
       ad.descripcion 'area destino',
	   er.descripcion 'estado recepcion'
from Recepcion r
inner join Envio e on r.codEnvio = e.codEnvio
-- Datos del documento
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
-- Datos del tipo documento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- Área destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
-- Estado de la recepcion
INNER JOIN Estado er ON r.codEstado = er.codEstado
where e.codUsuarioEnvio = 2



-- listar el seguimiento de un documento
select e.codEnvio, 
       LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', 
	   e.fechaEnvio,
       e.folios, 
       e.observaciones,
	   d.NumDocumento, 
       td.descripcion 'tipo documento',
	   CONCAT(pe.nombres, ' ',pe.apellidos) 'usuario origen', 
	   ae.descripcion 'area origen',
	   CONCAT(pd.nombres, ' ' ,pd.apellidos) 'usuario destino', 
       ad.descripcion 'area destino',
	   er.descripcion 'estado recepcion'
from Recepcion r
inner join Envio e on r.codEnvio = e.codEnvio
-- Datos del documento
INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento
-- Datos del tipo documento
INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento
-- Usuario origen
INNER JOIN UsuarioArea uae ON e.codUsuarioEnvio = uae.codUsuario
INNER JOIN Usuario ue ON uae.codUsuario = ue.codUsuario
INNER JOIN Persona pe ON ue.codPersona = pe.codPersona
-- Área origen 
INNER JOIN Area ae ON uae.codArea = ae.codArea
-- Usuario destino
INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario
INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario
INNER JOIN Persona pd ON ud.codPersona = pd.codPersona
-- Área destino 
INNER JOIN Area ad ON uad.codArea = ad.codArea
-- Estado de la recepcion
INNER JOIN Estado er ON r.codEstado = er.codEstado
where e.NumDocumento = '9013'




---- Modulo de AREAS
-- listar todos los usuarios de una area determinada excepto el usuario logeado
select ua.codUsuarioArea, concat(p.nombres, p.apellidos) 'usuario' 
from UsuarioArea ua 
inner join Area a on ua.codArea = a.codArea
inner join Usuario u on ua.codUsuario = u.codUsuario
inner join Persona p on u.codPersona = p.codPersona 
where a.codArea = 1 and ua.codUsuarioArea != 4

----- Modulo de USUARIOS
select * from Usuario
select * from Documento

-- autenticar usuario
select ua.codUsuario, u.nombreUsuario, CONCAT(p.nombres, p.apellidos) 'nombres',
r.descripcion 'rol', a.descripcion 'area'
from Usuario u
inner join Rol r on u.codRol = r.codRol
inner join UsuarioArea ua on u.codUsuario = ua.codUsuario
inner join Area a on ua.codArea = a.codArea
inner join Persona p on u.codPersona = p.codPersona
where u.nombreUsuario = 'mvegap' and u.password = 'admin123'

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
-- Estados
insert into Estado(descripcion) values('habilitado'),('deshabilitado'),('derivado'),('pendiente de envio')

-- Areas
insert into Area(descripcion, codEstado) values('Fiscalizacion', 3)

-- Usuarios y Administrados
insert into Usuario(usuario, password, codEstado) values('aortizv', '1234', 3)
insert into Administrado(nombres, apellidos, telefono, codArea, codUsuario, codEstado)
values('Anderson', 'Ortiz Valle', '912032031', 1, 1, 3)

insert into Usuario(usuario, password, codEstado) values('avasquezr', '1234', 3)
insert into Administrado(nombres, apellidos, telefono, codArea, codUsuario, codEstado)
values('Andrea', 'Vasquez Rojas', '912001111', 1, 2, 3)

-- Documentos
insert into Documento(NroDocumento, asunto, folios, codEstado, codTipoDocumento, fechaRegistro)
values('9844', 'Deducción', 1, 3, 1, '30-05-2024')

-- Envio
insert into Envio(fechaEnvio, codAdministrado, codEstado, nroDocumento)
values('30-05-2024', 1, 5, '9844')

-- Recepcion
insert into Recepcion(fechaRecepcion, codAdministrado, codEstado, nroDocumento)
values('01-06-2024', 2, 1, '9844')

-- Movimientos
insert into Movimiento(codEnvio, codRecepcion, NroDocumento)
values(1, 1, '9844')

select * from area
select * from Estado
select * from Usuario
select * from Administrado
select * from TipoDocumento
select * from Documento
select * from Envio
select * from Recepcion
select * from movimiento



-- consulta seguimiento

select d.NroDocumento, d.asunto, d.folios, tp.descripcion as 'Tipo Documento',
e.fechaEnvio as 'Fecha Derivacion', a.nombres as 'Administrador Origen', 
r.fechaRecepcion as 'Fecha Recepcion', ar.nombres as 'Administrado Recepcion'
from movimiento as m
inner join Documento as d on m.NroDocumento = d.NroDocumento
inner join TipoDocumento as tp on d.codTipoDocumento = tp.codTipoDocumento
inner join Envio as e on d.NroDocumento = e.nroDocumento
inner join Recepcion as r on d.NroDocumento = r.nroDocumento
inner join Administrado as a on e.codAdministrado = a.codAdministrado
inner join Administrado as ar on r.codAdministrado = ar.codAdministrado

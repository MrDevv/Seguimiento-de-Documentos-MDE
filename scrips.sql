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

----- movimiento 1
-- Envio
insert into Envio(fechaEnvio, codAdministrado, codEstado)
values('30-05-2024', 1, 5, '9844')
-- Recepcion
insert into Recepcion(fechaRecepcion, codAdministrado, codEstado)
values('01-06-2024', 2, 1, '9844')

----- movimiento 2
-- Envio
insert into Envio(fechaEnvio, codAdministrado, codEstado)
values('02-06-2024', 2, 5, '9844')
-- Recepcion
insert into Recepcion(fechaRecepcion, codAdministrado, codEstado)
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
select * from Recepcion;
select * from movimiento;

update Recepcion set fechaRecepcion = NULL where codRecepcion = 1

-- consulta documentos pendientes de recepcion
select d.NroDocumento 'NUMERO DE DOCUMENTO', d.folios 'FOLIOS', d.asunto 'ASUNTO', tp.descripcion 'TIPO DOCUMENTO',
aro.descripcion 'AREA ORIGEN', concat(a.nombres, ' ', a.apellidos) 'ADMINISTRADO ORIGEN', e.fechaEnvio 'FECHA DERIVACION',  e.observacion 'OBSERVACION', ee.descripcion 'ESTADO ENVIO'
from Movimiento as m
inner join Documento as d on m.NroDocumento = d.NroDocumento
inner join TipoDocumento as tp on d.codTipoDocumento = tp.codTipoDocumento
inner join Envio as e on m.codEnvio = e.codEnvio
inner join Administrado as a on e.codAdministrado = a.codAdministrado
inner join Estado as ee on ee.codEstado = e.codEstado
inner join Area aro on aro.codArea = a.codArea
where ee.descripcion = 'derivado';

-- consulta detalle movimiento de un documento
select d.NroDocumento 'NUMERO DE DOCUMENTO', d.folios 'FOLIOS', d.asunto 'ASUNTO', tp.descripcion 'TIPO DOCUMENTO',
aro.descripcion 'AREA ORIGEN', a.nombres 'ADMINISTRADO ORIGEN', e.fechaEnvio 'FECHA DERIVACION',  e.observacion 'OBSERVACION', ee.descripcion 'ESTADO ENVIO',
ard.descripcion 'AREA DESTINO', ar.nombres 'ADMINISTRADO RECEPCION', r.fechaRecepcion 'FECHA RECEPCION', er.descripcion 'ESTADO RECEPCION'
from Movimiento as m
inner join Documento as d on m.NroDocumento = d.NroDocumento
inner join TipoDocumento as tp on d.codTipoDocumento = tp.codTipoDocumento
inner join Envio as e on m.codEnvio = e.codEnvio
inner join Recepcion as r on m.codRecepcion = r.codRecepcion
inner join Administrado as a on e.codAdministrado = a.codAdministrado
inner join Administrado as ar on r.codAdministrado = ar.codAdministrado
inner join Estado as ee on ee.codEstado = e.codEstado
inner join Estado er on er.codEstado = r.codEstado
inner join Area aro on aro.codArea = a.codArea
inner join Area ard on ard.codArea = ar.codArea

-- cosulta ver seguimiento de un documento
select d.NroDocumento 'NUMERO DE DOCUMENTO', d.folios 'FOLIOS', d.asunto 'ASUNTO', tp.descripcion 'TIPO DOCUMENTO',
aro.descripcion 'AREA ORIGEN', a.nombres 'ADMINISTRADO ORIGEN', e.fechaEnvio 'FECHA DERIVACION',  e.observacion 'OBSERVACION', ee.descripcion 'ESTADO ENVIO',
ard.descripcion 'AREA DESTINO', ar.nombres 'ADMINISTRADO RECEPCION', r.fechaRecepcion 'FECHA RECEPCION', er.descripcion 'ESTADO RECEPCION'
from Movimiento as m
inner join Documento as d on m.NroDocumento = d.NroDocumento
inner join TipoDocumento as tp on d.codTipoDocumento = tp.codTipoDocumento
inner join Envio as e on m.codEnvio = e.codEnvio
inner join Recepcion as r on m.codRecepcion = r.codRecepcion
inner join Administrado as a on e.codAdministrado = a.codAdministrado
inner join Administrado as ar on r.codAdministrado = ar.codAdministrado
inner join Estado as ee on ee.codEstado = e.codEstado
inner join Estado er on er.codEstado = r.codEstado
inner join Area aro on aro.codArea = a.codArea
inner join Area ard on ard.codArea = ar.codArea

select * from Movimiento

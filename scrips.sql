----------- INSERT DE DATOS INICIALES DEL SISTEMA

-- Estados del sistema
insert into Estado(descripcion) values('n'), ('a'), ('i'), ('e'), ('p');
go

-- Roles del sistema
insert into Rol(descripcion) values('administrador'), ('usuario');
go

-- Movimientos del sistema
insert into Movimiento(descripcion) values('Solicitar'),('Conocimientos  y Fines'),('Opinar y/o Informar'), ('Inspección Ocular'), ('Adjuntar Antecedentes');
go

-- Areas del Sistema
insert into Area(descripcion) values('SubGerencia de Informática y Sistemas');
go

-- Tipo Documento
insert into TipoDocumento(descripcion) values('Oficio'),('Acta de Constatacion'),('Carta'),('Citación'),('Constancia'), ('Denuncia')
go

-- Personas
insert into Persona (nombres, apellidos, telefono, dni, codEstado)
values 
('Jose Bernardo', 'Castro Gonzales', '934003123', '71830493',2)
go

insert into Usuario (nombreUsuario, password, codRol, codPersona, codEstado)
values 
('jcastrog', 'admin', 1, 1, 2)
go

insert into UsuarioArea (codUsuario, codArea, codEstado)
values
(1, 1, 2)
go
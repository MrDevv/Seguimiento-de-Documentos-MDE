CREATE DATABASE Sistema_Seguimiento_Documentos;

use Sistema_Seguimiento_Documentos;

CREATE TABLE Rol(
	codRol INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(20) NOT NULL,
	PRIMARY KEY(codRol)
);

CREATE TABLE Estado(
	codEstado INT NOT NULL IDENTITY(1,1),
	descripcion CHAR(1) NOT NULL,
	PRIMARY KEY(codEstado)
);

CREATE TABLE Persona(
	codPersona INT NOT NULL IDENTITY(1,1),
	nombres VARCHAR(50) NOT NULL,
	apellidos VARCHAR(50) NOT NULL,
	telefono VARCHAR(9) NOT NULL,
	dni VARCHAR(8) NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codPersona),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);

CREATE TABLE Usuario(
	codUsuario INT NOT NULL IDENTITY(1,1),
	nombreUsuario VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	codRol INT NOT NULL,
	codPersona INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codUsuario),
	FOREIGN KEY(codRol) REFERENCES Rol(codRol),
	FOREIGN KEY(codPersona) REFERENCES Persona(codPersona),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);

CREATE TABLE Area(
	codArea INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(50) NOT NULL,
	PRIMARY KEY(codArea),
);

CREATE TABLE UsuarioArea(
	codUsuarioArea INT NOT NULL IDENTITY(1,1),
	codUsuario INT NOT NULL,
	codArea INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codUsuarioArea),
	FOREIGN KEY(codUsuario) REFERENCES Usuario(codUsuario),
	FOREIGN KEY(codArea) REFERENCES Area(codArea),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);

CREATE TABLE Movimiento(
	codMovimiento INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(50) NOT NULL,
	PRIMARY KEY(codMovimiento)
);

CREATE TABLE TipoDocumento(
	codTipoDocumento INT NOT NULL IDENTITY(1,1),
	descripcion VARCHAR(50) NOT NULL,
	PRIMARY KEY(codTipoDocumento)
);

CREATE TABLE Documento(
	NumDocumento VARCHAR(20) NOT NULL,
	asunto VARCHAR(300) NOT NULL,
	folios INT NOT NULL,
	horaRegistro TIME NOT NULL,
	fechaRegistro DATE NOT NULL,
	codUsuario INT NOT NULL,
	codTipoDocumento INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(NumDocumento),
	FOREIGN KEY(codUsuario) REFERENCES UsuarioArea(codUsuarioArea),
	FOREIGN KEY(codTipoDocumento) REFERENCES TipoDocumento(codTipoDocumento),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);

CREATE TABLE Envio(
	codEnvio INT NOT NULL IDENTITY(1,1),
	fechaEnvio DATE NOT NULL,
	horaEnvio TIME NOT NULL,
	folios INT NOT NULL,
	observaciones VARCHAR(300),
	codMovimiento INT NOT NULL,
	NumDocumento VARCHAR(20) NOT NULL,
	codUsuarioEnvio INT NOT NULL,
	codUsuarioDestino INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codEnvio),
	FOREIGN KEY(codMovimiento) REFERENCES Movimiento(codMovimiento),
	FOREIGN KEY(NumDocumento) REFERENCES Documento(NumDocumento),
	FOREIGN KEY(codUsuarioEnvio) REFERENCES UsuarioArea(codUsuarioArea),
	FOREIGN KEY(codUsuarioDestino) REFERENCES UsuarioArea(codUsuarioArea),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);

CREATE TABLE Recepcion(
	codRecepcion INT NOT NULL IDENTITY(1,1),
	codEnvio INT NOT NULL,
	fechaRecepcion DATE NOT NULL,
	horaRecepcion TIME NOT NULL,
	codUsuarioRecepcion INT NOT NULL,
	codEstado INT NOT NULL,
	PRIMARY KEY(codRecepcion),
	FOREIGN KEY(codEnvio) REFERENCES Envio(codEnvio),
	FOREIGN KEY(codUsuarioRecepcion) REFERENCES UsuarioArea(codUsuarioArea),
	FOREIGN KEY(codEstado) REFERENCES Estado(codEstado)
);
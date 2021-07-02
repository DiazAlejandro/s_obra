CREATE DATABASE IF NOT EXISTS ctrl_obra;

USE ctrl_obra;

CREATE TABLE data_entities (
	iddata_entities INT PRIMARY KEY AUTO_INCREMENT,
	calle VARCHAR (80) NOT NULL, 
	colonia VARCHAR (45) NOT NULL, 
	municipio VARCHAR (100) NOT NULL, 
	estado  VARCHAR (50) NOT NULL, 
	statusd  VARCHAR (45) NOT NULL
);

-- Tabla Clientes 
CREATE TABLE cliente (
	idcliente INT PRIMARY KEY AUTO_INCREMENT,
	nombre    VARCHAR(45) NOT NULL,
	apellidos VARCHAR(60) NOT NULL,
	sexo VARCHAR(1) NOT NULL,
	telefono  VARCHAR(10) NOT NULL,
	correo_e  VARCHAR(25) NOT NULL,
	fecha_registro DATE NOT NULL,
	iddata_entities INT, 
	FOREIGN KEY (iddata_entities)
		REFERENCES data_entities(iddata_entities)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	UNIQUE (correo_e)
);

CREATE TABLE responsable (
	idresponsable INT PRIMARY KEY AUTO_INCREMENT,
	nombre    VARCHAR(45) NOT NULL,
	apellidos VARCHAR(60) NOT NULL,
	correo_e  VARCHAR(45) NOT NULL,
	telefono  VARCHAR(10) NOT NULL,
	iddata_entities INT, 
	FOREIGN KEY (iddata_entities)
		REFERENCES data_entities(iddata_entities)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	UNIQUE (correo_e),
	UNIQUE (telefono)
);


CREATE TABLE proveedor_material (
	rfc_proveedor VARCHAR(13) PRIMARY KEY,
	razon_social  VARCHAR(70) NOT NULL,
	correo_e  VARCHAR(45) NOT NULL,
	telefono  VARCHAR(10) NOT NULL,
	iddata_entities INT, 
	FOREIGN KEY (iddata_entities)
		REFERENCES data_entities(iddata_entities)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	UNIQUE (correo_e),
	UNIQUE (telefono)
);

CREATE TABLE material (
	idmaterial  INT PRIMARY KEY AUTO_INCREMENT,
	nombre      VARCHAR(100) NOT NULL,
	descripcion VARCHAR(255) NOT NULL,
	precio      DOUBLE(10,2) NOT NULL,
	unidad      VARCHAR(100) NOT NULL,
	rfc_proveedor VARCHAR(13),
	FOREIGN KEY (rfc_proveedor)
		REFERENCES proveedor_material(rfc_proveedor)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE obra (
	idobra         INT PRIMARY KEY AUTO_INCREMENT,
	nombre_obra    VARCHAR(45) NOT NULL,
	fecha_registro DATE NOT NULL,
	avance         SMALLINT(3) NOT NULL, 
	tipo_obra      VARCHAR(100) NOT NULL,
	fecha_inicio   DATE NOT NULL,
	fecha_fin      DATE NOT NULL,
	idcliente      INT,
	idresponsable  INT,
	iddata_entities INT, 
	FOREIGN KEY (iddata_entities)
		REFERENCES data_entities(iddata_entities)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idcliente)
		REFERENCES cliente(idcliente)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idresponsable)
		REFERENCES responsable(idresponsable)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE avance (
	idavance INT PRIMARY KEY AUTO_INCREMENT,
	fecha DATE NOT NULL,
	observaciones VARCHAR(255) NOT NULL,
	avance INT NOT NULL,
	idobra INT,
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
		ON DELETE CASCADE 
		ON UPDATE CASCADE

);
CREATE TABLE cotizacion (
	idcotizacion    INT PRIMARY KEY AUTO_INCREMENT,
	tiempo_estimado VARCHAR(45) NOT NULL,
	capital_humano  INT,
	costo           DOUBLE(10,2) NOT NULL,
	documento_cotizacion VARCHAR(255),
	pago_acumulado  DOUBLE(10,2) NOT NULL,
	idobra          INT,
	UNIQUE (documento_cotizacion),
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
		ON DELETE CASCADE 
		ON UPDATE CASCADE
);

CREATE TABLE plano (
	idplano         INT PRIMARY KEY AUTO_INCREMENT,
	documento_plano VARCHAR(255) NOT NULL,
	descripcion     VARCHAR(255) NOT NULL,
	idobra          INT NOT NULL,
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
		ON DELETE CASCADE 
		ON UPDATE CASCADE
);

CREATE TABLE contrato (
	idcontrato      INT PRIMARY KEY AUTO_INCREMENT,
	fecha           DATE NOT NULL,
	costo           DOUBLE(10,2) NOT NULL,
	descripcion     VARCHAR(255) NOT NULL,
	derechos        VARCHAR(255) NOT NULL,
	obligaciones    VARCHAR(255) NOT NULL,
	documento_contrato VARCHAR(255) NOT NULL,
	idcliente       INT NOT NULL,
	idobra          INT NOT NULL,
	idcotizacion    INT NOT NULL,
	UNIQUE (documento_contrato),
	FOREIGN KEY (idcliente)
		REFERENCES cliente(idcliente)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idcotizacion)
		REFERENCES cotizacion(idcotizacion)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE pago (
	folio       INT PRIMARY KEY AUTO_INCREMENT,
	concepto    VARCHAR(255) NOT NULL,
	monto       DOUBLE(10,2) NOT NULL,
	fecha       DATE NOT NULL,
	documento_pago VARCHAR(255) NOT NULL,
	idcliente       INT NOT NULL,
	idcotizacion    INT NOT NULL,
	UNIQUE (documento_pago),
	FOREIGN KEY (idcliente)
		REFERENCES cliente(idcliente)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idcotizacion)
		REFERENCES cotizacion(idcotizacion)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE entrega (
	identrega INT PRIMARY KEY AUTO_INCREMENT,
	fecha     DATE NOT NULL,
	observaciones VARCHAR(255) NOT NULL,
	documento_entrega VARCHAR(255) NOT NULL,
	idobra            INT NOT NULL, 
	idresponsable     INT NOT NULL, 
	UNIQUE(documento_entrega),
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idresponsable)
		REFERENCES responsable(idresponsable)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE cotizacion_material (
	idcotizacion INT NOT NULL, 
	idmaterial   INT NOT NULL, 
	cantidad     INT NOT NULL,
	costo        INT NOT NULL,
	FOREIGN KEY (idcotizacion)
		REFERENCES cotizacion(idcotizacion)
			ON DELETE CASCADE 
			ON UPDATE CASCADE,
	FOREIGN KEY (idmaterial)
		REFERENCES material(idmaterial)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

CREATE TABLE permiso (
	idpermiso INT PRIMARY KEY AUTO_INCREMENT,
	documento_permiso VARCHAR(255) NOT NULL,
	idobra            INT NOT NULL, 
	fecha_inicio      DATE NOT NULL,
	fecha_vencimiento DATE NOT NULL,
	UNIQUE(documento_permiso),
	FOREIGN KEY (idobra)
		REFERENCES obra(idobra)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
);

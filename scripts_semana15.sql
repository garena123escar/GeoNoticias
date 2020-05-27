-- DROP TABLE roles CASCADE;
-- DROP TABLE usuarios CASCADE;

CREATE TABLE roles (
  id_rol SERIAL  NOT NULL ,
  descripcion VARCHAR(30),
PRIMARY KEY(id_rol));


CREATE TABLE usuarios (
  id_usuario  SERIAL  NOT NULL ,
  usuario VARCHAR(60)    ,
  nombre VARCHAR(60)    ,
  apellido VARCHAR(60)    ,
  telefono VARCHAR(30)    ,
  contrasena VARCHAR(40)    ,
  correo VARCHAR(60)    ,
  id_rol INTEGER      ,
PRIMARY KEY(id_usuario )  ,
  FOREIGN KEY(id_rol)
    REFERENCES roles(id_rol)
      ON DELETE RESTRICT
      ON UPDATE RESTRICT);


-- Creo Roles para los usuarios
INSERT INTO roles (id_rol, descripcion) VALUES(1,'Administrador');
INSERT INTO roles (id_rol, descripcion) VALUES(2,'Usuario Web');


-- Creo  Usuarios
INSERT INTO usuarios(usuario , nombre, apellido, telefono, contrasena, correo, id_rol) 
VALUES('andresh','Andres', 'Herrera' , '656454556' , md5('12345'), 'fabio.herrera@correounivalle.edu.co',1);

INSERT INTO usuarios(usuario , nombre, apellido, telefono, contrasena, correo, id_rol) 
VALUES('pedrito','Pedrito', 'Perez' , '5555555555' , md5('54321'), 'pedrito.perez@correounivalle.edu.co',2);

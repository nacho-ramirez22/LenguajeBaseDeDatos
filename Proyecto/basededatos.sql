-- CREACCION DE LAS TABLAS
CREATE TABLE usuario (
    ID_Usuario INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    nombre VARCHAR2(20),
    apellido VARCHAR2(30),
    telefono INT,
    username VARCHAR2(50),
    password VARCHAR2(30),
    ID_Rol INT,
    CONSTRAINT PK_Usuario PRIMARY KEY(ID_Usuario),
    CONSTRAINT FK_Rol FOREIGN KEY (ID_Rol) REFERENCES rol(ID_Rol)
);
--Table USUARIO creado.

CREATE TABLE tour (
    ID_Tour INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    Tipo VARCHAR2(30),
    CONSTRAINT PK_Tour PRIMARY KEY(ID_Tour)
);
-- Table TOUR creado.

CREATE TABLE actividad (
    ID_Actividad INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    nombre_actividad VARCHAR2(30),
    CONSTRAINT PK_Actividad PRIMARY KEY(ID_Actividad)
);
-- Table ACTIVIDAD creado.

CREATE TABLE menu (
    ID_Menu INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    comida VARCHAR2(30),
    bebida VARCHAR2(30),
    CONSTRAINT PK_Menu PRIMARY KEY(ID_Menu)
);
-- Table MENU creado.

CREATE TABLE comentarios (
    ID_Comentario INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    comentario VARCHAR2(100),
    ID_Usuario INT,
    CONSTRAINT PK_Comentario PRIMARY KEY(ID_Comentario),
    CONSTRAINT FK_Usuario FOREIGN KEY (ID_Usuario) REFERENCES usuario(ID_Usuario)
);
-- Table COMENTARIOS creado.

CREATE TABLE provincia (
    ID_Provincia INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    provincia VARCHAR2(30),
    CONSTRAINT PK_Provincia PRIMARY KEY(ID_Provincia)
);
-- Table PROVINCIA creado.

CREATE TABLE lugarSalida (
    ID_ls INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    ID_Provincia INT,
    LugarSalida VARCHAR2(30),
    CONSTRAINT PK_LS PRIMARY KEY(ID_ls),
    CONSTRAINT FK_Provincia FOREIGN KEY (ID_Provincia) REFERENCES provincia(ID_Provincia)
);
-- Table LUGARSALIDA creado.

CREATE TABLE paquetes (
    ID_Paquete INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    ID_Provincia INT,
    ID_Menu INT,
    ID_Tour INT,
    ID_Actividad INT,
    ID_ls INT,
    Destino VARCHAR2(30),
    Fecha DATE,
    Precio INT,
    CONSTRAINT PK_Paquete PRIMARY KEY(ID_Paquete),
    CONSTRAINT FK_Provincia_P FOREIGN KEY (ID_Provincia) REFERENCES provincia(ID_Provincia),
    CONSTRAINT FK_Menu_P FOREIGN KEY (ID_Menu) REFERENCES menu(ID_Menu),
    CONSTRAINT FK_Tour_P FOREIGN KEY (ID_Tour) REFERENCES tour(ID_Tour),
    CONSTRAINT FK_Actividad_P FOREIGN KEY (ID_Actividad) REFERENCES actividad(ID_Actividad),
    CONSTRAINT FK_LS_P FOREIGN KEY (ID_ls) REFERENCES lugarSalida(ID_ls)
);
-- Table PAQUETES creado.

CREATE TABLE factura (
    ID_Factura INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    ID_Usuario INT,
    ID_Paquete INT,
    CONSTRAINT PK_Factura PRIMARY KEY(ID_Factura),
    CONSTRAINT FK_Usuario_F FOREIGN KEY (ID_Usuario) REFERENCES usuario(ID_Usuario),
    CONSTRAINT FK_Paquete_F FOREIGN KEY (ID_Paquete) REFERENCES paquetes(ID_Paquete)
);
-- Table FACTURA creado.

CREATE TABLE rol (
    ID_Rol INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
    rol VARCHAR2(10),
    CONSTRAINT PK_Rol PRIMARY KEY(ID_Rol)
);
-- Table ROL creado.




-------------------------------------




--PROCEDIMIENTOS ALMACENADOS

--TABLA USUARIO 
CREATE OR REPLACE PROCEDURE agregar_usuario (
    p_nombre IN VARCHAR2,
    p_apellido IN VARCHAR2,
    p_telefono IN INT,
    p_username IN VARCHAR2,
    p_password IN VARCHAR2
)
AS
BEGIN
    INSERT INTO usuario (nombre, apellido, telefono, username, password)
    VALUES (p_nombre, p_apellido, p_telefono, p_username, p_password);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Usuario agregado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar usuario');
END;

CREATE OR REPLACE PROCEDURE editar_usuario (
    p_id_usuario IN INT,
    p_nombre IN VARCHAR2,
	p_apellido IN VARCHAR2,
	p_telefono IN INT,
	p_password IN VARCHAR2
)
AS
BEGIN
    UPDATE usuario 
    SET nombre = p_nombre,
	apellido = p_apellido,
	telefono = p_telefono,
	password = p_password
    WHERE ID_Usuario = p_id_usuario;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Usuario editado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar usuario');
END;

CREATE OR REPLACE PROCEDURE eliminar_usuario (
    p_id_usuario IN INT
)
AS
BEGIN
    DELETE FROM usuario 
    WHERE ID_Usuario = p_id_usuario;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Usuario eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar Usuario');
END;

--TABLA TOUR CRUD
CREATE OR REPLACE PROCEDURE agregar_tour (
    p_Tipo IN VARCHAR2
)
AS
BEGIN
    INSERT INTO tour (Tipo)
    VALUES (p_Tipo);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Tour agregado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar Tour');
END;

CREATE OR REPLACE PROCEDURE editar_tour (
    p_id_tour IN INT,
    p_Tipo IN VARCHAR2
)
AS
BEGIN
    UPDATE tour 
    SET tipo = p_Tipo
    WHERE id_tour = p_id_tour;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Tour editado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar Tour');
END;

CREATE OR REPLACE PROCEDURE eliminar_tour (
    p_id_tour IN INT
)
AS
BEGIN
    DELETE FROM tour 
    WHERE id_tour = p_id_tour;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Tour eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar Tour');
END;

CREATE OR REPLACE PROCEDURE eliminar_usuario (
    p_id_usuario IN INT
)
AS
BEGIN
    DELETE FROM usuario 
    WHERE ID_Usuario = p_id_usuario;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Usuario eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar Usuario');
END;

--TABLA ACTIVIDAD CRUD
CREATE OR REPLACE PROCEDURE agregar_actividad (
    p_nombre_actividad IN VARCHAR2
)
AS
BEGIN
    INSERT INTO actividad (nombre_actividad)
    VALUES (p_nombre_actividad);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Actividad agregada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar actividad');
END;

CREATE OR REPLACE PROCEDURE editar_actividad (
    p_id_actividad IN INT,
    p_nombre_actividad IN VARCHAR2
)
AS
BEGIN
    UPDATE actividad 
    SET nombre_actividad = p_nombre_actividad
    WHERE id_actividad = p_id_actividad;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Actividad editada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar actividad');
END;

CREATE OR REPLACE PROCEDURE eliminar_actividad (
    p_id_actividad IN INT
)
AS
BEGIN
    DELETE FROM actividad 
    WHERE id_actividad = p_id_actividad;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Actividad eliminada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar actividad');
END;

--TABLA MENU CRUD
CREATE OR REPLACE PROCEDURE agregar_menu (
    p_comida IN VARCHAR2,
    p_bebida IN VARCHAR2
)
AS
BEGIN
    INSERT INTO menu (comida, bebida)
    VALUES (p_comida, p_bebida);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Menu agregado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar menu');
END;

CREATE OR REPLACE PROCEDURE editar_menu (
    p_id_menu IN INT,
    p_comida IN VARCHAR2,
    p_bebida IN VARCHAR2
)
AS
BEGIN
    UPDATE menu 
    SET comida = p_comida,
        bebida = p_bebida
    WHERE ID_Menu = p_id_menu;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Menu editada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar menu');
END;

CREATE OR REPLACE PROCEDURE eliminar_menu (
    p_id_menu IN INT
)
AS
BEGIN
    DELETE FROM menu 
    WHERE ID_Menu = p_id_menu;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Menu eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar menu');
END;

-- TABLA COMENTARIOS CRUD
CREATE OR REPLACE PROCEDURE agregar_comentario (
    p_comentario IN VARCHAR2,
    p_id_Usuario IN INT
)
AS
BEGIN
    INSERT INTO comentarios (comentario, ID_Usuario)
    VALUES (p_comentario, p_id_Usuario);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Comentario agregado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar comentario');
END;

CREATE OR REPLACE PROCEDURE editar_comentario (
    p_id_comentario IN INT,
    p_comentario IN VARCHAR2,
    p_ID_Usuario IN VARCHAR2
)
AS
BEGIN
    UPDATE comentarios 
    SET comentario = p_comentario
    WHERE ID_Comentario = p_id_comentario;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Comentario editada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar comentario');
END;

CREATE OR REPLACE PROCEDURE eliminar_comentario (
    p_id_comentario IN INT
)
AS
BEGIN
    DELETE FROM comentarios 
    WHERE ID_Comentario = p_id_comentario;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Comentario eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar comentario');
END;

-- TABLA PROVINCIA CRUD
CREATE OR REPLACE PROCEDURE agregar_provincia (
    p_provincia IN VARCHAR2
)
AS
BEGIN
    INSERT INTO provincia (provincia)
    VALUES (p_provincia);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Provincia agregada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar provincia');
END;

CREATE OR REPLACE PROCEDURE editar_provincia (
    p_id_provincia IN INT,
    p_provincia IN VARCHAR2
)
AS
BEGIN
    UPDATE provincia 
    SET provincia = p_provincia
    WHERE ID_Provincia = p_id_provincia;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Provincia editada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar provincia');
END;

CREATE OR REPLACE PROCEDURE eliminar_provincia (
    p_id_provincia IN INT
)
AS
BEGIN
    DELETE FROM provincia 
    WHERE ID_Provincia = p_id_provincia;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Provincia eliminada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar provincia');
END;

-- TABLA LUGARSALIDA CRUD
CREATE OR REPLACE PROCEDURE agregar_lugarSalida (
    p_id_provincia IN INT,
    p_ls IN VARCHAR2
)
AS
BEGIN
    INSERT INTO lugarSalida (ID_Provincia,LugarSalida)
    VALUES (p_id_provincia, p_ls);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Lugar de salida agregado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar lugar de salida');
END;

CREATE OR REPLACE PROCEDURE editar_lugarSalida (
    p_id_ls IN INT,
    p_id_provincia IN INT,
	p_ls IN VARCHAR2
)
AS
BEGIN
    UPDATE lugarSalida
    SET ID_Provincia = p_id_provincia,
	LugarSalida = p_ls
    WHERE ID_ls = p_id_ls;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Lugar de salida editado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar lugar de salida');
END;

CREATE OR REPLACE PROCEDURE eliminar_lugarSalida (
    p_id_ls IN INT
)
AS
BEGIN
    DELETE FROM lugarSalida 
    WHERE ID_ls = p_id_ls;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Lugar de salida eliminada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar lugar de salida');
END;

-- TABLA PAQUETES CRUD
CREATE OR REPLACE PROCEDURE agregar_paquete (
    p_id_provincia IN INT,
    p_id_menu IN INT,
    p_id_tour IN INT,
    p_id_actividad IN INT,
    p_id_ls IN INT,
    p_destino IN VARCHAR2,
    p_fecha IN DATE,
    p_precio IN INT
)
AS
BEGIN
    INSERT INTO paquetes (ID_Provincia, ID_Menu, ID_Tour, ID_Actividad, ID_ls, Destino, Fecha, Precio)
    VALUES (p_id_provincia, p_id_menu, p_id_tour, p_id_actividad, p_id_ls, p_destino, p_fecha, p_precio);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Paquete agregada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar paquete');
END;

CREATE OR REPLACE PROCEDURE editar_paquete (
    p_id_paquete IN INT,
    p_id_provincia IN INT,
    p_id_menu IN INT,
    p_id_tour IN INT,
    p_id_actividad IN INT,
    p_id_ls IN INT,
    p_destino IN VARCHAR2,
    p_fecha IN DATE,
    p_precio IN INT
)
AS
BEGIN
    UPDATE paquetes
    SET ID_Provincia = p_id_provincia,
	ID_Menu = p_id_menu,
	ID_Tour = p_id_tour,
	ID_Actividad = p_id_actividad,
	ID_ls = p_id_ls,
	Destino = p_destino,
	Fecha = p_fecha,
	Precio = p_precio
    WHERE ID_Paquete = p_id_paquete;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Paquete editado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar paquete');
END;

CREATE OR REPLACE PROCEDURE eliminar_paquete (
    p_id_paquete IN INT
)
AS
BEGIN
    DELETE FROM paquetes 
    WHERE ID_Paquete = p_id_paquete;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Paquete eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar paquete');
END;

-- TABLA FACTURA CRUD
CREATE OR REPLACE PROCEDURE agregar_factura (
    p_id_usuario IN INT,
    p_id_paquete IN INT
)
AS
BEGIN
    INSERT INTO factura (ID_Usuario, ID_Paquete)
    VALUES (p_id_usuario, p_id_paquete);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Factura agregada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar factura');
END;

CREATE OR REPLACE PROCEDURE editar_factura (
    p_id_factura IN INT,
    p_id_usuario IN INT,
    p_id_paquete IN INT
)
AS
BEGIN
    UPDATE factura 
    SET ID_Usuario = p_id_usuario,
        ID_Paquete = p_id_paquete
    WHERE ID_Factura = p_id_factura;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Factura editada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar factura');
END;

CREATE OR REPLACE PROCEDURE eliminar_factura (
    p_id_factura IN INT
)
AS
BEGIN
    DELETE FROM factura 
    WHERE ID_Factura = p_id_factura;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Factura eliminada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar factura');
END;

-- TABLA ROL CRUD
CREATE OR REPLACE PROCEDURE agregar_rol (
    p_rol IN VARCHAR2
)
AS
BEGIN
    INSERT INTO rol (rol)
    VALUES (p_rol);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Rol agregada exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al agregar rol');
END;

CREATE OR REPLACE PROCEDURE editar_rol (
    p_id_rol IN INT,
    p_rol IN VARCHAR2
)
AS
BEGIN
    UPDATE rol 
    SET rol = p_rol
    WHERE ID_Rol = p_id_rol;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Rol editado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al editar Rol');
END;

CREATE OR REPLACE PROCEDURE eliminar_rol (
    p_id_rol IN INT
)
AS
BEGIN
    DELETE FROM rol 
    WHERE ID_Rol = p_id_rol;
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Rol eliminado exitosamente');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al eliminar rol');
END;



--PENDIENTE CURSORES---

----FUNCIONES----
--1 Precio Maximo PAQUETES
CREATE OR REPLACE FUNCTION PRECIO_MAXIMO RETURN INT IS
v_PRECIO_MAXIMO INT := 0;
BEGIN
SELECT MAX(Precio)
INTO v_PRECIO_MAXIMO
FROM PAQUETES;
RETURN v_PRECIO_MAXIMO;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0; 
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error con el precio máximo de los paquetes: ' || SQLERRM);
RETURN NULL;
END PRECIO_MAXIMO;

--2 Precio Minimo PAQUETES
CREATE OR REPLACE FUNCTION PRECIO_MINIMO RETURN INT IS
v_PRECIO_MINIMO INT := 0;
BEGIN
SELECT MIN(PRECIO)
INTO v_PRECIO_MINIMO
FROM PAQUETES;
RETURN v_PRECIO_MINIMO;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0; 
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error con el precio mínimo de los paquetes: ' || SQLERRM);
RETURN NULL;
END PRECIO_MINIMO;

--3 Lugar de salida por el ID
CREATE OR REPLACE FUNCTION LUGAR_SALIDA(
PA_ID_LUGAR_SALIDA INT) RETURN VARCHAR2 IS
VAR_LUGAR_SALIDA VARCHAR2(80); 
CURSOR CUR_LUGAR_SALIDA IS
SELECT LUGARSALIDA
FROM LUGARSALIDA
WHERE ID_LS = PA_ID_LUGAR_SALIDA; 
BEGIN
OPEN CUR_LUGAR_SALIDA;
FETCH CUR_LUGAR_SALIDA INTO VAR_LUGAR_SALIDA;
CLOSE CUR_LUGAR_SALIDA;
RETURN VAR_LUGAR_SALIDA;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN NULL;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error con el lugar de salida: ' || SQLERRM);
RETURN NULL;
END LUGAR_SALIDA;

--4 Nombre Actividad
CREATE OR REPLACE FUNCTION NOMBRE_ACTIVIDAD(
PA_ID_ACTIVIDAD INT) RETURN VARCHAR2 IS
VAR_NOMBRE_ACTIVIDAD VARCHAR2(80);
CURSOR CUR_NOMBRE_ACTIVIDAD IS
SELECT NOMBRE_ACTIVIDAD
FROM ACTIVIDAD
WHERE ID_ACTIVIDAD = PA_ID_ACTIVIDAD;
BEGIN
OPEN CUR_NOMBRE_ACTIVIDAD;
FETCH CUR_NOMBRE_ACTIVIDAD INTO VAR_NOMBRE_ACTIVIDAD;
CLOSE CUR_NOMBRE_ACTIVIDAD;
RETURN VAR_NOMBRE_ACTIVIDAD;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN NULL;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error con el nombre de la actividad: ' || SQLERRM);
RETURN NULL;
END NOMBRE_ACTIVIDAD;

--5 Nombre Provincia
CREATE OR REPLACE FUNCTION PROVINCIA(P_NOMBRE IN VARCHAR2) RETURN SYS_REFCURSOR IS
VAR_CURSOR SYS_REFCURSOR;
BEGIN
OPEN VAR_CURSOR FOR
SELECT * FROM PROVINCIA
WHERE UPPER(PROVINCIA) = UPPER(P_NOMBRE);
RETURN VAR_CURSOR;
END PROVINCIA;

--6 Total Usuarios
CREATE OR REPLACE FUNCTION USUARIOS RETURN INT IS
TOTAL_USUARIO INT := 0;
BEGIN
SELECT COUNT (*)
INTO TOTAL_USUARIO
FROM USUARIO;
RETURN TOTAL_USUARIO;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE ('Error al contar los usuarios:' || SQLERRM);
RETURN NULL;
END USUARIOS;


--7 Actividades disponibles
CREATE OR REPLACE FUNCTION NUMERO_ACTIVIDADES RETURN INT IS
VAR_NUM_ACTIVIDADES INT := 0;
BEGIN
SELECT COUNT(*)
INTO VAR_NUM_ACTIVIDADES
FROM ACTIVIDAD;
RETURN VAR_NUM_ACTIVIDADES;
EXCEPTION WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al contar el número de actividades disponibles: ' || SQLERRM);
RETURN NULL;
END NUMERO_ACTIVIDADES;

--8 Total gastado por un usuario
CREATE OR REPLACE FUNCTION TOTAL_GASTADO(
ID_USUARIO INT
) RETURN INT IS 
TOTAL_GASTADO INT := 0;
BEGIN
SELECT SUM (P.PRECIO)
INTO TOTAL_GASTADO
FROM FACTURA F
JOIN PAQUETES P ON F.ID_Paquete = P.ID_Paquete
WHERE F.ID_USUARIO = ID_USUARIO;
RETURN TOTAL_GASTADO;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE ('Error al calcular el monto gastado:' || SQLERRM);
RETURN NULL;
END TOTAL_GASTADO;


--9  Cuántos tours hay de acuerdo al tipo
CREATE OR REPLACE FUNCTION TOURS_POR_TIPO (P_TIPO IN VARCHAR2) RETURN INT IS
VAR_NUMERO_TOURS INT := 0;
BEGIN
SELECT COUNT(*)
INTO VAR_NUMERO_TOURS
FROM TOUR
WHERE TIPO = TOURS_POR_TIPO.P_TIPO;
RETURN VAR_NUMERO_TOURS;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al contar los tours: ' || SQLERRM);
RETURN NULL;
END TOURS_POR_TIPO;


--10 Ver si un usuario ha agregado comentarios
CREATE OR REPLACE FUNCTION COMENTARIOS_USUARIO(ID_USUARIO IN INT) RETURN INT IS
VAR_HAY_COMENTARIOS INT := 0;
BEGIN
SELECT COUNT(*)
INTO VAR_HAY_COMENTARIOS
FROM COMENTARIOS
WHERE ID_USUARIO = COMENTARIOS_USUARIO.ID_USUARIO;
RETURN CASE WHEN VAR_HAY_COMENTARIOS > 0 THEN 1 ELSE 0 END;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al verificar los comentarios del usuario: ' || SQLERRM);
RETURN NULL;
END COMENTARIOS_USUARIO;

--11 Paquetes disponibles para fecha específica

CREATE OR REPLACE FUNCTION PAQUETES_FECHA(P_FECHA IN DATE) RETURN INT IS
VAR_CANT_PAQUETES INT := 0;
BEGIN
SELECT COUNT(*)
INTO VAR_CANT_PAQUETES
FROM PAQUETES
WHERE FECHA = PAQUETES_FECHA.P_FECHA;
RETURN VAR_CANT_PAQUETES;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al buscar paquetes para esa fecha: ' || SQLERRM);
RETURN NULL;
END PAQUETES_FECHA;


--12 Destino más popular de acuerdo a paquetes vendidos
CREATE OR REPLACE FUNCTION DESTINO_POPULAR RETURN VARCHAR2 IS
VAR_DESTINO VARCHAR2(30);
BEGIN
SELECT DESTINO INTO VAR_DESTINO
FROM (SELECT DESTINO, COUNT(*) AS CANT_PAQUETES
FROM PAQUETES
GROUP BY DESTINO
ORDER BY CANT_PAQUETES DESC)
WHERE ROWNUM = 1;
RETURN VAR_DESTINO;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN NULL;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al obtener el destino más popular: ' || SQLERRM);
RETURN NULL;
END DESTINO_POPULAR;

--13 Total de paquetes vendidos por provincia
CREATE OR REPLACE FUNCTION PAQUETES_POR_PROVINCIA(P_ID_PROVINCIA IN INT) RETURN INT IS
VAR_PAQUETES INT;
BEGIN
SELECT COUNT(*) INTO VAR_PAQUETES
FROM PAQUETES
WHERE ID_PROVINCIA = P_ID_PROVINCIA;
RETURN VAR_PAQUETES;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN 0;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al calcular el total de paquetes por provincia: ' || SQLERRM);
RETURN NULL;
END PAQUETES_POR_PROVINCIA;


--14 Nombre del destino más barato por provincia
CREATE OR REPLACE FUNCTION DESTINO_MAS_BARATO_PROVINCIA(P_ID_PROVINCIA IN INT) RETURN VARCHAR2 IS
VAR_DESTINO VARCHAR2(30);
BEGIN
SELECT DESTINO INTO VAR_DESTINO
FROM (SELECT DESTINO, MIN(PRECIO) AS PRECIO_MAS_BARATO
FROM PAQUETES
WHERE ID_PROVINCIA = P_ID_PROVINCIA
GROUP BY DESTINO
ORDER BY PRECIO_MAS_BARATO ASC)
WHERE ROWNUM = 1;
RETURN VAR_DESTINO;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN NULL;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al obtener el destino más barato: ' || SQLERRM);
RETURN NULL;
END DESTINO_MAS_BARATO_PROVINCIA;

--15 Provincia con más paquetes vendidos
CREATE OR REPLACE FUNCTION PROVINCIA_CON_MAS_VENTAS RETURN VARCHAR2 IS
VAR_PROVINCIA VARCHAR2(30);
BEGIN
SELECT PROVINCIA INTO VAR_PROVINCIA
FROM (SELECT P.ID_PROVINCIA, PRO.PROVINCIA, COUNT(*) AS CANT_PAQUETES
FROM PAQUETES P
JOIN PROVINCIA PRO ON p.ID_PROVINCIA = PRO.ID_PROVINCIA
GROUP BY P.ID_PROVINCIA, PRO.PROVINCIA
ORDER BY CANT_PAQUETES DESC)
WHERE ROWNUM = 1;
RETURN VAR_PROVINCIA;
EXCEPTION
WHEN NO_DATA_FOUND THEN
RETURN NULL;
WHEN OTHERS THEN 
DBMS_OUTPUT.PUT_LINE('Error al obtener la provincia con el mayor número de paquetes vendidos: ' || SQLERRM);
RETURN NULL;
END PROVINCIA_CON_MAS_VENTAS;



-------------------------------------------------------------------------



--VISTAS
CREATE OR REPLACE VIEW vista_usuario AS SELECT id_usuario, nombre, apellido, telefono, username from Usuario;

CREATE OR REPLACE VIEW vista_tour AS SELECT id_tour, Tipo from tour;

CREATE OR REPLACE VIEW vista_actividad AS SELECT id_actividad, nombre_actividad from actividad;

CREATE OR REPLACE VIEW vista_menu AS SELECT id_menu, 'Comida: '|| comida ||' - Bebida: '||bebida as "MENU" from menu;

CREATE OR REPLACE VIEW vista_comentario AS SELECT c.ID_Comentario, c.comentario, u.username FROM comentarios c JOIN usuario u ON c.ID_Usuario = u.ID_Usuario;

CREATE OR REPLACE VIEW vista_provincia AS SELECT id_provincia, provincia from Provincia;

CREATE OR REPLACE VIEW vista_lugarSalida AS SELECT l.id_ls, p.provincia, l.LugarSalida from lugarSalida l JOIN provincia p ON p.ID_Provincia = l.ID_Provincia;

CREATE OR REPLACE VIEW vista_paquete AS SELECT p.id_paquete, p.destino, pr.provincia, t.tipo, a.nombre_actividad, m.comida, m.bebida, l.lugarSalida, p.fecha, p.precio FROM paquetes p 
JOIN provincia pr ON p.id_provincia = pr.id_provincia JOIN tour t ON p.id_tour = t.id_tour JOIN actividad a ON p.id_actividad = a.id_actividad JOIN menu m ON p.id_menu = m.id_menu JOIN lugarSalida l ON p.id_ls = l.id_ls;

CREATE OR REPLACE VIEW vista_factura AS SELECT f.id_factura, u.nombre|| ' ' ||u.apellido as "NOMBRE", p.destino, p.fecha, p.precio FROM factura f JOIN 
usuario u ON u.ID_Usuario = f.ID_Usuario JOIN paquetes p ON p.ID_Paquete = f.ID_Paquete;

CREATE OR REPLACE VIEW vista_rol AS SELECT id_rol, rol FROM rol;


--------------------------------------

--TRIGGERS

CREATE OR REPLACE TRIGGER tr_paquete_insert
AFTER INSERT ON paquetes
FOR EACH ROW
DECLARE
    operacion VARCHAR2(10);
BEGIN
    operacion := 'INSERT';
    INSERT INTO AuditoriaPaquetes (Tipo_Operacion, Fecha_Operacion, ID_Paquete, ID_Provincia, 
                                ID_Menu, ID_Tour, ID_Actividad, ID_ls, Destino, Fecha, Precio)
    VALUES (operacion, SYSTIMESTAMP, :NEW.ID_Paquete, :NEW.ID_Provincia, 
            :NEW.ID_Menu, :NEW.ID_Tour,:NEW.ID_Actividad, :NEW.ID_ls, :NEW.Destino, :NEW.Fecha, :NEW.Precio);
END;
-- Trigger TR_PAQUETE_INSERT compilado

CREATE OR REPLACE TRIGGER tr_paquete_update
AFTER UPDATE ON paquetes
FOR EACH ROW
DECLARE
    operacion VARCHAR2(10);
BEGIN
    operacion := 'UPDATE';
    INSERT INTO AuditoriaPaquetes (Tipo_Operacion, Fecha_Operacion, ID_Paquete, ID_Provincia, 
                                    ID_Menu, ID_Tour, ID_Actividad, ID_ls, Destino, Fecha, Precio)
    VALUES (operacion, SYSTIMESTAMP, :OLD.ID_Paquete, :OLD.ID_Provincia, 
            :OLD.ID_Menu, :OLD.ID_Tour, :OLD.ID_Actividad, :OLD.ID_ls, :OLD.Destino, :OLD.Fecha, :OLD.Precio);
END;
-- Trigger TR_PAQUETE_UPDATE compilado

CREATE OR REPLACE TRIGGER tr_paquete_delete
AFTER DELETE ON paquetes
FOR EACH ROW
DECLARE
    operacion VARCHAR2(10);
BEGIN
    operacion := 'DELETE';
    INSERT INTO AuditoriaPaquetes (Tipo_Operacion, Fecha_Operacion, ID_Paquete, ID_Provincia, 
                                    ID_Menu, ID_Tour, ID_Actividad, ID_ls, Destino, Fecha, Precio)
    VALUES (operacion, SYSTIMESTAMP, :OLD.ID_Paquete, :OLD.ID_Provincia, 
            :OLD.ID_Menu, :OLD.ID_Tour, :OLD.ID_Actividad, :OLD.ID_ls, :OLD.Destino, :OLD.Fecha, :OLD.Precio);
END;
-- Trigger TR_PAQUETE_DELETE compilado
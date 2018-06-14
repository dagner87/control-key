CREATE TRIGGER movimientosAlcli_AI AFTER INSERT ON almacen_clientes FOR EACH ROW 
INSERT INTO movi_al_cli(fecha,id_producto,id_almacen,id_cliente,cantidad_entrada)
VALUES (NOW(),NEW.id_producto,NEW.id_almacen,NEW.id_cliente,NEW.stock)

//trigger udpate 
CREATE TRIGGER actu_moviAlcli_BU BEFORE UPDATE ON almacen_clientes FOR EACH ROW INSERT INTO movi_al_cli(fecha,id_producto,id_almacen,id_cliente,cantidad_entrada,cantidad_salida) VALUES (NOW(),NEW.id_producto,NEW.id_almacen,NEW.id_cliente,NEW.stock,OLD.stock)
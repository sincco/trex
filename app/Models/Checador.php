<?php

class ChecadorModel extends Sincco\Sfphp\Abstracts\Model 
{
	public function checada($data)
	{
		$query = "INSERT INTO checadas SET empleado=:empleado, fecha=NOW(), reloj=:reloj, foto=:foto;";
		return $this->connector->query($query,$data);
	}

	public function getChecadasDia($data)
	{
		$query = "SELECT empleado, numeroEmpleado, nombre, foto, MAX(entradaFecha) entradaFecha, MAX(entradaFoto) entradaFoto, MAX(entradaReloj) entradaReloj, MAX(salidaFecha) salidaFecha, MAX(salidaFoto) salidaFoto, MAX(salidaReloj) salidaReloj FROM (SELECT tmp.*, chc.foto entradaFoto, NULL salidaFoto, chc.reloj entradaReloj, NULL salidaReloj FROM (SELECT chc.empleado, emp.numeroEmpleado, emp.nombre, emp.foto, DATE(chc.fecha) fecha, MIN(chc.fecha) entradaFecha, '1900-01-01 00:00:01' salidaFecha FROM checadas chc INNER JOIN empleados emp USING(empleado) WHERE DATE(fecha) BETWEEN '" . $data['fechaInicio'] . "' AND '" . $data['fechaFin'] . "' GROUP BY chc.empleado, emp.numeroEmpleado, emp.nombre, emp.foto, DATE(fecha)) tmp INNER JOIN checadas chc ON (tmp.empleado=chc.empleado AND tmp.entradaFecha=chc.fecha) UNION ALL SELECT tmp.*, NULL entradaFoto, chc.foto salidaFoto, NULL entradaReloj, chc.reloj salidaReloj FROM (SELECT chc.empleado, emp.numeroEmpleado, emp.nombre, emp.foto, DATE(chc.fecha) fecha, '1900-01-01 00:00:01' entradaFecha, MAX(chc.fecha) salidaFecha FROM checadas chc INNER JOIN empleados emp USING(empleado) WHERE DATE(fecha) BETWEEN '" . $data['fechaInicio'] . "' AND '" . $data['fechaFin'] . "' GROUP BY chc.empleado, emp.numeroEmpleado, emp.nombre, emp.foto, DATE(fecha)) tmp INNER JOIN checadas chc ON (tmp.empleado=chc.empleado AND tmp.salidaFecha=chc.fecha)) tmp GROUP BY empleado, numeroEmpleado, nombre, foto, fecha ORDER BY numeroEmpleado;";
		return $this->connector->query($query);
	}
}
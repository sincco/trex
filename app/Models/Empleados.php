<?php

class EmpleadosModel extends Sincco\Sfphp\Abstracts\Model 
{
	public function getAll($data = [])
	{
		$query = "SELECT * FROM empleados";
		return $this->connector->query($query,$data);
	}

	public function getData()
	{
		$query = "SELECT empleado, numeroEmpleado, nombre FROM empleados WHERE estatus='A';";
		return $this->connector->query($query);
	}

	public function save($data) 
	{
		$query = "INSERT INTO empleados SET numeroEmpleado='" . $data['numeroEmpleado'] . "', nombre='" . $data['nombre'] . "', foto='" . $data['foto'] . "', departamento=1, estatus='A' ON DUPLICATE KEY UPDATE foto='". $data['foto'] . "';";
		return $this->connector->query($query);
	}

}
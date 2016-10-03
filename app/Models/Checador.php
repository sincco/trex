<?php

class ChecadorModel extends Sincco\Sfphp\Abstracts\Model 
{
	public function checada($data) {
		$query = "INSERT INTO checadas SET empleado=:empleado, fecha=NOW(), reloj=:reloj, foto=:foto;";
		return $this->connector->query($query,$data);
	}
}
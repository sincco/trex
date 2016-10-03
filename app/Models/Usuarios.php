<?php

class UsuariosModel extends Sincco\Sfphp\Abstracts\Model {

	public function getAll() {
		$query = 'SELECT usr.userId, usr.userName FROM __usersControl usr;';
		return $this->connector->query( $query );
	}

	public function getByUserName( $data ) {
		$query = 'SELECT usr.userId, usr.userName FROM __usersControl usr WHERE usr.userName = :userName;';
		return $this->connector->query( $query, ['userName'=>$data] );
	}
}
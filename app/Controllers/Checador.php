<?php
use \Sincco\Tools\Login;
use \Sincco\Sfphp\Request;

/**
 * Control de reloj
 */
class ChecadorController extends Sincco\Sfphp\Abstracts\Controller {
	/**
	 * Validar si el usuario está loggeado para accesar al dashboard
	 * @return none
	 */
	public function index() {
		$view = $this->newView('Checador');
		$view->render();
	}

}
<?php
use \Sincco\Sfphp\Response;

/**
 * Control de reloj
 */
class EmpleadosController extends Sincco\Sfphp\Abstracts\Controller {
	/**
	 * Validar si el usuario está loggeado para accesar al dashboard
	 * @return none
	 */
	public function index() {
		$view = $this->newView('EmpleadosTabla');
		$view->empleados = $this->getModel('Empleados')->getData();
		$view->menus = $this->helper('UsersAccount')->createMenus();
		$view->render();
	}

	public function asignaFoto() {
		$data = $this->getParams('data');
		$data['foto'] = $this->getParams('foto');
		new Response('json',['respuesta'=>$this->getModel('Empleados')->save($data)]);
	}
}
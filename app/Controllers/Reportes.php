<?php
use \Sincco\Sfphp\Response;

/**
 * Control de reloj
 */
class ReportesController extends Sincco\Sfphp\Abstracts\Controller {
	/**
	 * Validar si el usuario está loggeado para accesar al dashboard
	 * @return none
	 */
	public function checadas() {
		$this->helper('UsersAccount')->checkLogin();
		$view = $this->newView('ReporteChecadas');
		if (trim($this->getParams('fechaInicio')) != '') {
			$view->checadas = $this->getModel('Checador')->getChecadasDia($this->getParams());
		}
		$view->desde = $this->getParams('fechaInicio');
		$view->hasta = $this->getParams('fechaFin');
		$view->menus = $this->helper('UsersAccount')->createMenus();
		$view->render();
	}

	public function asignaFoto() {
		$data = $this->getParams('data');
		$data['foto'] = $this->getParams('foto');
		new Response('json',['respuesta'=>$this->getModel('Empleados')->save($data)]);
	}
}
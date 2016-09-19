<?php

use \Sincco\Sfphp\Response;

class FormatosController extends Sincco\Sfphp\Abstracts\Controller {
	public function index() {
		$this->helper('UsersAccount')->checkLogin();
		$userData = $this->helper('UsersAccount')->getUserData('user\extra');
		$cuadrilla = $userData['cuadrilla']['cuadrilla'];
		$view = $this->newView('Gestion\FormatosTabla');
		$view->cuadrilla = $cuadrilla;
		$view->menus = $this->helper('UsersAccount')->createMenus();
		$view->render();
	}

	public function imprimir () {
		$contratos = $this->getParams('contratos');
		$ids = "'" . implode("','", $contratos) . "'";
		$userData = $this->helper('UsersAccount')->getUserData('user\extra');
		$contratos = $this->getModel('Expedientes\Contratos')->getByIds($ids);
		$view = $this->newView('Gestion\FormatosImpresion');
		$view->supervisor = $userData['cuadrilla']['nombre'];
		$view->contratos = $contratos;
		$view->render();
	}

	public function terminados () {
		$contratos = $this->getParams('contratos');
		$ids = "'" . implode("','", $contratos) . "'";
		$contratos = $this->getModel('Expedientes\Contratos')->getReporteTerminados($ids);
		$view = $this->newView('Gestion\FormatosImpresionTerminados');
		$view->contratos = $contratos;
		$view->render();
	}

	public function apiAdjuntos() {
		$contrato = $this->getParams('contrato');
		$files = scandir(PATH_ROOT . '/_expedientes/' . $contrato);
		array_shift($files);
		array_shift($files);
		$adjuntos = array();
		foreach ($files as $adjunto) {

			array_push($adjuntos, str_replace(' ', '%20', $adjunto));
		}
		new Response( 'json', [ 'respuesta'=>count($adjuntos), 'adjuntos'=>$adjuntos ] );
	}

}
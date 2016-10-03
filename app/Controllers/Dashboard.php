<?php

use \Sincco\Sfphp\Request;

/**
 * Dashboard del sistema
 */
class DashboardController extends Sincco\Sfphp\Abstracts\Controller {
	
	/**
	 * Acción por default
	 * @return none
	 */
	public function index() {
		Request::redirect('reportes/checadas');
	}
}
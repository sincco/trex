<?php
use \Sincco\Sfphp\Response;

/**
 * Control de reloj
 */
class ChecadorController extends Sincco\Sfphp\Abstracts\Controller {
	/**
	 * Validar si el usuario está loggeado para accesar al dashboard
	 * @return none
	 */
	public function index() {
		$view = $this->newView('ChecadorKeyboard');
		$view->reloj = intval($this->getParams('reloj'));
		if ($view->reloj == 0) {
			$view->reloj = 1;
		}
		$view->empleados = json_encode($this->UTF8Parser($this->getModel('Empleados')->getData()));
		$view->render();
	}

	public function apiChecada() {
		$data = $this->getParams();
		$model = $this->getModel('Checador');
		new Response('json',['respuesta'=>$model->checada($data)]);
		#$data = $this->getParams('foto');
		#list($type, $data) = explode(';', $data);
		#list(, $data)      = explode(',', $data);
		#$data = base64_decode($data);
		#file_put_contents('/tmp/image.png', $data);
	}

	public static function UTF8Parser( $array ) {
		array_walk_recursive( $array, function( &$item, $key ){
			if(!mb_detect_encoding( $item, 'utf-8', true ))
				$item = utf8_encode( $item );
		});
		return $array;
	}
}
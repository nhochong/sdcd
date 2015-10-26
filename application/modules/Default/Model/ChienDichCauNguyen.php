<?php
class Default_Model_ChienDichCauNguyen extends Khcn_Model_Item_Abstract{
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'chien-dich-cau-nguyen',
			'action' => 'chi-tiet',
			'reset' => true,
			'id' => $this->getIdentity()
		), $params);
		$route = $params['route'];
		$reset = $params['reset'];
		unset($params['route']);
		unset($params['reset']);
		return Zend_Controller_Front::getInstance()->getRouter()
		  ->assemble($params, $route, $reset);
	}
}
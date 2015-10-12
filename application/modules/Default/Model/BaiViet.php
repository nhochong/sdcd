<?php
class Default_Model_BaiViet extends Khcn_Model_Item_Abstract{
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'bai-viet',
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
	
	public function getLoai(){
		return Khcn_Api::_()->getItem('default_loai_bai_viet', $this->loai_bai_viet_id);
	}
}
<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiTinTuc extends Khcn_Model_Item_Abstract
{
	public function getDanhSachTinTuc(){
		return Khcn_Api::_()->getDbTable('tin_tuc', 'default')->getDanhSachSuDiep(array('loai_tin_tuc_id' => $this->getIdentity())); 
	}
	
	public function getParentTitle(){
		$parent = Khcn_Api::_()->getItem('default_loai_tin_tuc', $this->parent_id);
		if($parent){
			return $parent->getTitle();
		}
		return '';
	}
}

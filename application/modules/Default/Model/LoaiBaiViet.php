<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiBaiViet extends Khcn_Model_Item_Abstract
{
	public function getDanhSachBaiViets(){
		return Khcn_Api::_()->getDbTable('bai_viet', 'default')->getDanhSachBaiViets(array('loai_bai_viet_id' => $this->getIdentity())); 
	}
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiDgh extends Khcn_Model_Item_Abstract
{
	public function getDanhSachDgh(){
		return Khcn_Api::_()->getDbTable('dgh', 'default')->getDanhSachDgh(array('loai_dgh_id' => $this->getIdentity())); 
	}
}

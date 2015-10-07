<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiSuDiep extends Khcn_Model_Item_Abstract
{
	public function getDanhSachSuDiep(){
		return Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep(array('loai_su_diep_id' => $this->getIdentity())); 
	}
}

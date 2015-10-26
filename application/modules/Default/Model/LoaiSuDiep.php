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
	
	public function getParentTitle(){
		$parent = Khcn_Api::_()->getItem('default_loai_su_diep', $this->parent_id);
		if($parent){
			return $parent->getTitle();
		}
		return '';
	}
	
	public function getChilds(){
		$table = Khcn_Api::_()->getDbTable('loai_su_diep', 'default');
		$select = $table->select()->where('parent_id = ?',$this->getIdentity());
		return $table->fetchAll($select);
	}
}

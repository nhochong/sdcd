<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiThongTin extends Khcn_Model_Item_Abstract
{
	public function getDanhSachThongTin(){
		return Khcn_Api::_()->getDbTable('thong_tin', 'default')->getDanhSachThongTin(array('loai_thong_tin_id' => $this->getIdentity())); 
	}
	
	public function getParentTitle(){
		$parent = Khcn_Api::_()->getItem('default_loai_thong_tin', $this->parent_id);
		if($parent){
			return $parent->getTitle();
		}
		return '';
	}
	
	public function getChilds(){
		$table = Khcn_Api::_()->getDbTable('loai_thong_tin', 'default');
		$select = $table->select()->where('parent_id = ?',$this->getIdentity());
		return $table->fetchAll($select);
	}
}

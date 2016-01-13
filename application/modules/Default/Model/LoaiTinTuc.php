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
		return Khcn_Api::_()->getDbTable('tin_tuc', 'default')->getDanhSachTinTuc(array('loai_tin_tuc_id' => $this->getIdentity())); 
	}
	
	public function getParentTitle(){
		$parent = Khcn_Api::_()->getItem('default_loai_tin_tuc', $this->parent_id);
		if($parent){
			return $parent->getTitle();
		}
		return '';
	}
	
	public function getChilds(){
		$table = Khcn_Api::_()->getDbTable('loai_tin_tuc', 'default');
		$select = $table->select()->where('parent_id = ?',$this->getIdentity());
		return $table->fetchAll($select);
	}
	
	public function getRecursiveListIDs(){
		$childs = $this->getChilds();
		$arr = array();
		$arr[] = $this->getIdentity();
		foreach($childs as $child){
			$arr[] = $child->getIdentity();
		}
		return $arr;
	}
}

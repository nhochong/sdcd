<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiSuDiep extends Khcn_Db_Table
{
    protected $_name = 'loai_su_diep';
	
	protected $_rowClass = 'Default_Model_LoaiSuDiep';
	
	public function getListAssoc($parent_id = 0, &$results = array(), $level = 0){
		foreach($this->getByParent($parent_id) as $row){
			$title = ($level == 0) ? $row->getTitle() : '| ' . $row->getTitle();
			$results[$row->getIdentity()] = str_pad('', $level*2, '-', STR_PAD_LEFT) . $title;
			if($this->hasChild($row->getIdentity())){
				$this->getListAssoc($row->getIdentity(), $results, ++$level);
				--$level;
			}
		}
		return $results;
	}
	
	public function getByParent($parent_id){
		return $this->fetchAll($this->select()->where('parent_id = ?', $parent_id));
	}
	
	public function hasChild($parent_id){
		$row = $this->fetchRow($this->select()->where('parent_id = ?', $parent_id));
		if($row)
			return true;
		return false;
	}
	
	public function getParentListAssoc($default_option = true){
		$select = $this->select()->where('parent_id = 0');
		if($default_option)
			$results = array(0 => '');
		else
			$results = array();
		foreach($this->fetchAll($select) as $row){
			$results[$row->getIdentity()] = $row->getTitle();
		}
		return $results;
	}
	
	public function getParents(){
		$select = $this->select()->where('parent_id = 0');
		return $this->fetchAll($select);
	}
	
	function getListChildIds($parent_id){
		$childs = $this->getByParent($parent_id);
		$data = array();
		$data[] = $parent_id;
		foreach($childs as $child){
			$data[] = $child->getIdentity();
		}
		return $data;
	}
}

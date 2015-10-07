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
	
	public function getListAssoc(){
		$results = array();
		foreach($this->fetchAll() as $row){
			$results[$row->getIdentity()] = $row->getTitle();
		}
		return $results;
	}
}

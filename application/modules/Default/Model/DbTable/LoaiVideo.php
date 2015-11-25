<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiVideo extends Khcn_Db_Table
{
    protected $_name = 'loai_video';
	
	protected $_rowClass = 'Default_Model_LoaiVideo';
	
	public function getListAssoc(){
		$results = array();
		foreach($this->fetchAll() as $row){
			$results[$row->getIdentity()] = $row->getTitle();
		}
		return $results;
	}
}
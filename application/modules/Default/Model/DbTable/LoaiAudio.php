<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiAudio extends Khcn_Db_Table
{
    protected $_name = 'loai_audio';
	
	protected $_rowClass = 'Default_Model_LoaiAudio';
	
	public function getListAssoc(){
		$results = array();
		foreach($this->fetchAll() as $row){
			$results[$row->getIdentity()] = $row->getTitle();
		}
		return $results;
	}
}
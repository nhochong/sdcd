<?php
class Default_Model_DbTable_Dgh extends Khcn_Db_Table{
	
	protected $_name = 'dgh';
	
	protected $_rowClass = 'Default_Model_Dgh';
	
	public function getDanhSachDgh($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_dgh_id']) && !empty($params['loai_dgh_id'])){
			$select->where('loai_dgh_id = ?', $params['loai_dgh_id']);
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		return $this->fetchAll($select);
	}
	
}
<?php
class Default_Model_DbTable_SuDiep extends Khcn_Db_Table{
	
	protected $_name = 'su_diep';
	
	protected $_rowClass = 'Default_Model_SuDiep';
	
	public function getDanhSachSuDiep($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_su_diep_id']) && !empty($params['loai_su_diep_id'])){
			$select->where('loai_su_diep_id = ?', $params['loai_su_diep_id']);
		}
		
		return $this->fetchAll($select);
	}
}
<?php
class Default_Model_DbTable_SuDiep extends Khcn_Db_Table{
	
	protected $_name = 'su_diep';
	
	protected $_rowClass = 'Default_Model_SuDiep';
	
	public function getDanhSachSuDiep($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_su_diep_id']) && !empty($params['loai_su_diep_id'])){
			$loaiIds = Khcn_Api::_()->getDbTable('loai_su_diep', 'default')->getListChildIds($params['loai_su_diep_id']);
			$select->where('loai_su_diep_id IN (?)', $loaiIds);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('su_diep_id NOT IN (?)', $params['not_ids']);
		}
		
		if(isset($params['last_id']) && !empty($params['last_id'])){
			$select->where('su_diep_id < ?', $params['last_id']);
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		$select->order("ngay_tao DESC");
		
		return $this->fetchAll($select);
	}
}
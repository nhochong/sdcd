<?php
class Default_Model_DbTable_BaiViet extends Khcn_Db_Table{
	
	protected $_name = 'bai_viet';
	
	protected $_rowClass = 'Default_Model_BaiViet';
	
	public function getDanhSachBaiViets($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_bai_viet_id']) && !empty($params['loai_bai_viet_id'])){
			$select->where('loai_bai_viet_id = ?', $params['loai_bai_viet_id']);
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		return $this->fetchAll($select);
	}
}
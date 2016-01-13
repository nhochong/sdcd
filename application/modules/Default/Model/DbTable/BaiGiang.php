<?php
class Default_Model_DbTable_BaiGiang extends Khcn_Db_Table{
	
	protected $_name = 'bai_giang';
	
	protected $_rowClass = 'Default_Model_BaiGiang';
	
	public function getDanhSachBaiGiang($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['order'])){
			$direction = isset($params['direction']) ? $params['direction'] : 'DESC';
			$select->order($params['order'] . ' ' . $direction);
		}else{
			$select->order('ngay_tao DESC');
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		return $this->fetchAll($select);
	}
}
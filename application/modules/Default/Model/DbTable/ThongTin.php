<?php
class Default_Model_DbTable_ThongTin extends Khcn_Db_Table{
	
	protected $_name = 'thong_tin';
	
	protected $_rowClass = 'Default_Model_ThongTin';
	
	public function getDanhSachThongTin($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_thong_tin_id']) && !empty($params['loai_thong_tin_id'])){
			$select->where('loai_thong_tin_id = ?', $params['loai_thong_tin_id']);
		}
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['listCategoryIds']) && !empty($params['listCategoryIds'])){
			$select->where('loai_thong_tin_id in (?)', $params['listCategoryIds']);
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
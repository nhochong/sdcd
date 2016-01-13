<?php
class Default_Model_DbTable_Video extends Khcn_Db_Table{
	
	protected $_name = 'video';
	
	protected $_rowClass = 'Default_Model_Video';
	
	public function getDanhSachVideo($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_video_id']) && !empty($params['loai_video_id'])){
			$select->where('loai_video_id = ?', $params['loai_video_id']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['listCategoryIds']) && !empty($params['listCategoryIds'])){
			$select->where('loai_video_id in (?)', $params['listCategoryIds']);
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
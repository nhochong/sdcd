<?php
class Default_Model_DbTable_Audio extends Khcn_Db_Table{
	
	protected $_name = 'audio';
	
	protected $_rowClass = 'Default_Model_Audio';
	
	public function getDanhSachAudio($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_audio_id']) && !empty($params['loai_audio_id'])){
			$select->where('loai_audio_id = ?', $params['loai_audio_id']);
		}
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['listCategoryIds']) && !empty($params['listCategoryIds'])){
			$select->where('loai_audio_id in (?)', $params['listCategoryIds']);
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
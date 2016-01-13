<?php
class Default_Model_DbTable_TinTuc extends Khcn_Db_Table{
	
	protected $_name = 'tin_tuc';
	
	protected $_rowClass = 'Default_Model_TinTuc';
	
	public function getTinTuc($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
	
    public function danhsachhienthi($params = array())
    {
		$select = $this->select()
						->where('trang_thai = 1')
						->order('noi_bat DESC')
						->order('ngay_tao DESC');
						
		if(!empty($params['limit'])){
			$select->limit($params['limit']);
		}
		return $this->fetchAll($select);
    }
    
	public function GetDSTT()
    {
    	$cols = array('id','tieu_de','mo_ta_tom_tat','ngay_tao','file');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function GetDSTTForRSS()
    {
    	$cols = array('id','tieu_de','mo_ta_tom_tat','ngay_tao');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC')
    					  ->limit(15,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
    public function GetTinTucKhac($id1,$id2)
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->where('id != ?',$id1)
    					  ->where('id != ?',$id2)
    					  ->order('ngay_tao DESC')
    					  ->limit(3,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getFile($id)
    {
    	$cols = array('id','file');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function CapNhatTT($id,$status)
    {
    	$data = array(
	            'trang_thai' => 1 - $status,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
    
	public function getDanhSachTinTuc($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['loai_tin_tuc_id']) && !empty($params['loai_tin_tuc_id'])){
			$select->where('loai_tin_tuc_id = ?', $params['loai_tin_tuc_id']);
		}
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['listCategoryIds']) && !empty($params['listCategoryIds'])){
			$select->where('loai_tin_tuc_id in (?)', $params['listCategoryIds']);
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
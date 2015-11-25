<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiVideo extends Khcn_Model_Item_Abstract
{
	public function getDanhSachDgh(){
		return Khcn_Api::_()->getDbTable('video', 'default')->getDanhSachVideo(array('loai_video_id' => $this->getIdentity())); 
	}
}

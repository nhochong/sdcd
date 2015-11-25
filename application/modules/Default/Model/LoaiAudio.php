<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiAudio extends Khcn_Model_Item_Abstract
{
	public function getDanhSachAudio(){
		return Khcn_Api::_()->getDbTable('audio', 'default')->getDanhSachAudio(array('loai_audio_id' => $this->getIdentity())); 
	}
}

<?php
class Default_Model_YoutubeChannel extends Khcn_Model_Item_Abstract{
	public function getLink(){
		if(strpos($this->link, 'http://') === FALSE){
			return 'http://' . $this->link;
		}
		return $this->link;
	}
}
<?php
class Admin_Form_Audio extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post');
		
		$this->addElement('Hidden', 'search', array(
			'value' => 1
		));
        
        $tieu_de = new Zend_Form_Element_Text('tieu_de');       
        $tieu_de->setLabel('Tiêu đề (*)')
               	->setRequired(true)
               	->addFilter('StripTags')
               	->addFilter('StringTrim')
                ->addValidator('NotEmpty')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 90%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input large-input');
		
		$cateOptions = Khcn_Api::_()->getDbTable('loai_audio', 'default')->getListAssoc();
        $loai_audio_id = new Zend_Form_Element_Select('loai_audio_id');
        $loai_audio_id->setLabel('Loại (*)')
			 ->addMultiOptions($cateOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');
			 
		$noi_dung = new Zend_Form_Element_Textarea('noi_dung');       
        $noi_dung->setLabel('Nội dung (*)')
               	 ->setRequired(true)
                 ->addValidator('NotEmpty')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'noi_dung','class' => 'text-input textarea'));
		
		$soundcloud_embed = new Zend_Form_Element_Text('soundcloud_embed');       
        $soundcloud_embed->setLabel('Embed SoundCloud')
				->setDescription('How to get SoundCloud embed code? <a href="http://help.soundcloud.com/customer/portal/articles/243751-how-can-i-put-my-track-or-playlist-on-my-site-or-blog-" target="_blank">Click here</a>')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'div','escape' => false, 'placement' => 'append')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 90%')),
							    array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input large-input');
				
		$statusOptions = array(
        "multiOptions" => Default_Model_Constraints::trang_thai());	
		$trang_thai = new Zend_Form_Element_Radio('trang_thai',$statusOptions);
		$trang_thai->setRequired(true)
				   ->setLabel('Trạng thái')
				   ->setValue('1')
				   ->setSeparator('')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 

		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $_SERVER['HTTP_REFERER'] . '"'));
			
		$this->addElements(array($tieu_de, $loai_audio_id, $noi_dung, $soundcloud_embed, $trang_thai, $submitCon, $submitExit, $cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table')),
					'Form',
					));
    }
}
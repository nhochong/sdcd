<?php
class Admin_Form_Dgh extends Zend_Form{
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

		$cateOptions = Khcn_Api::_()->getDbTable('loai_dgh', 'default')->getListAssoc();
        $loai_dgh_id = new Zend_Form_Element_Select('loai_dgh_id');
        $loai_dgh_id->setLabel('Loại (*)')
			 ->addMultiOptions($cateOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');   
						
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
		
		$noi_bat = new Zend_Form_Element_Select('noi_bat');
        $noi_bat->setLabel('Nổi Bật')
        	 ->setRequired(true)
			 ->setValue(0)
			 ->addMultiOptions(array(
				0 => 'Không',
				1 => 'Có'
			 ))
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$photo = new Zend_Form_Element_File('photo');
		$photo->setLabel('Upload hình')
			 ->setDescription('(*.jgp, *.gif, *.png , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/dgh')
			 ->addValidator(new Zend_Validate_File_Extension(array('jpg,gif,png')))
			 ->addValidator(new Zend_Validate_File_FilesSize(array('min' => 1, 
            													   'max' => 10485760,
            													   'bytestring' => true)))
			 ->setDecorators(array(
							    'File',
							    'Errors',	
			 					array('Description', array('escape' => false, 'tag' => 'div', 'placement' => 'append')),		 					
							    array('HtmlTag', array('tag' => 'td')),
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
			   
		$this->addElements(array($loai_dgh_id, $tieu_de, $noi_dung, $trang_thai, $noi_bat, $photo, $submitCon, $submitExit, $cancel));						

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
<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_GioiThieuController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
    	$form = new Admin_Form_GioiThieu();
        $this->view->form = $form;
		
		$form->populate(array(
			'gioi_thieu' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('gioi_thieu', '')
		));
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('gioi_thieu', $values['gioi_thieu']);
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
    }
    
	public function lienHeAction(){
		$form = new Admin_Form_LienHe();
        $this->view->form = $form;
		
		$form->populate(array(
			'lien_he' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('lien_he', '')
		));
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('lien_he', $values['lien_he']);
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
	}
}

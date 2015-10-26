<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LoaiSuDiepController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('loai_su_diep', 'default');
        $data = $table->fetchAll($table->select()->order('parent_id'));
        $paginator = Zend_Paginator::factory($data);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(5);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }

	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_LoaiTinTuc();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{		
				$values = $form->getValues();
				$table = Khcn_Api::_()->getDbTable('loai_su_diep', 'default');
				$loai_su_diep = $table->createRow();
				$loai_su_diep->setFromArray($values);
				$loai_su_diep->save();
								
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/loai-su-diep/them');					
				}else{
					$this->_redirect('/admin/loai-su-diep/index');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/loai-su-diep/index');
		}
		
    	$str = '';
		foreach($_POST['item'] as $id){
			$loai_su_diep = Khcn_Api::_()->getItem('default_loai_su_diep', $id);
			if($loai_su_diep != NULL)
			{			
				$loai_su_diep->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/loai-su-diep/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$loai_su_diep = Khcn_Api::_()->getItem('default_loai_su_diep', $id);
    		if($loai_su_diep != null){   			
    			$loai_su_diep->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/loai-su-diep/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/loai-su-diep/index');
    		}
    	}else{
    		$this->_redirect('/admin/loai-su-diep/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LoaiTinTuc();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$loai_su_diep = Khcn_Api::_()->getItem('default_loai_su_diep', $id);
		if(!$loai_su_diep){	     
			$_SESSION['msg'] = 'Lỗi !. không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/loai-su-diep/index');
		}
		           	
		$form->populate($loai_su_diep->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
        $values = $form->getValues();
		$loai_su_diep->setFromArray($values);
		$loai_su_diep->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/loai-su-diep/index');
	}
}

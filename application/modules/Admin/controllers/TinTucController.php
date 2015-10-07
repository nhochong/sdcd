<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_TinTucController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $tinTucs = Khcn_Api::_()->getDbTable('tin_tuc', 'default')->fetchAll();
        $paginator = Zend_Paginator::factory($tinTucs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_TinTuc();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$table = Khcn_Api::_()->getDbTable('tin_tuc', 'default');
		$tin_tuc = $table->createRow();
		$tin_tuc->setFromArray($values);
		$tin_tuc->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/tin-tuc/them');					
		}else{
			$this->_redirect('/admin/tin-tuc/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/tin-tuc/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
			if($tin_tuc != NULL)
			{
				//xoa database
				$tin_tuc->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/tin-tuc/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
    		if($tin_tuc != null){	
    			$tin_tuc->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/tin-tuc/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_TinTuc();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;     

		$id = $this->_getParam('id');
		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
		if(!$tin_tuc){	     
			$_SESSION['msg'] = 'Lỗi !. Dữ liệu không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/tin-tuc/index');
		}
		
		$form->populate($tin_tuc->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}	
		
        $values = $form->getValues();
		$tin_tuc->setFromArray($values);
		$tin_tuc->save();        
                
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/tin-tuc/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
    		if($tin_tuc != null){
	    		$tin_tuc->trang_thai = 1 - $status;
				$tin_tuc->save();
	    		$this->_redirect('/admin/tin-tuc/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/tin-tuc/index');
    	}
    }
}

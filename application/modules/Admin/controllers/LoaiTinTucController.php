<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LoaiTinTucController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('loai_tin_tuc', 'default');
        $loaiTTs = $table->fetchAll($table->select()->order('parent_id'));
        $paginator = Zend_Paginator::factory($loaiTTs);
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
				$table = Khcn_Api::_()->getDbTable('loai_tin_tuc', 'default');
				$loai_tin_tuc = $table->createRow();
				$loai_tin_tuc->setFromArray($values);
				$loai_tin_tuc->save();
								
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/loai-tin-tuc/them');					
				}else{
					$this->_redirect('/admin/loai-tin-tuc/index');
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
			$this->_redirect('/admin/loai-tin-tuc/index');
		}
		
    	$str = '';
		foreach($_POST['item'] as $id){
			$loai_sd = Khcn_Api::_()->getItem('default_loai_tin_tuc', $id);
			if($loai_sd != NULL)
			{			
				$loai_sd->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/loai-tin-tuc/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$loai_sd = Khcn_Api::_()->getItem('default_loai_tin_tuc', $id);
    		if($loai_sd != null){   			
    			$loai_sd->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/loai-tin-tuc/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/loai-tin-tuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/loai-tin-tuc/index');
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
		$loai_sd = Khcn_Api::_()->getItem('default_loai_tin_tuc', $id);
		if(!$loai_sd){	     
			$_SESSION['msg'] = 'Lỗi !. không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/loai-tin-tuc/index');
		}
		           	
		$form->populate($loai_sd->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
        $values = $form->getValues();
		$loai_sd->setFromArray($values);
		$loai_sd->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/loai-tin-tuc/index');
	}
}

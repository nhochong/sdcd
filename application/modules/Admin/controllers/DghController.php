<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DghController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $data = Khcn_Api::_()->getDbTable('dgh', 'default')->fetchAll(null, "ngay_tao DESC");
        $paginator = Zend_Paginator::factory($data);
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
        $form = new Admin_Form_Dgh();
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
		
		$table = Khcn_Api::_()->getDbTable('dgh', 'default');
		$dgh = $table->createRow();
		
		if($form->photo->getFileName(null,false) != null){
			//determine filename and extension 
			$info = pathinfo($form->photo->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->photo->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)))
					   ->addFilter(new Khcn_Filter_File_Resize(array(
							'width' => 720,
							'height' => 720,
							'keepRatio' => true,
						)));
			$form->getValue('photo');
			$dgh->file = $file;
		}
		
		$values = $form->getValues();
		$dgh->setFromArray($values);
		$dgh->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/dgh/them');					
		}else{
			$this->_redirect('/admin/dgh/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/dgh/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$dgh = Khcn_Api::_()->getItem('default_dgh', $id);
			if($dgh != NULL)
			{
				//xoa database
				$dgh->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/dgh/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$dgh = Khcn_Api::_()->getItem('default_dgh', $id);
    		if($dgh != null){	
    			$dgh->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/dgh/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/dgh/index');
    		}
    	}else{
    		$this->_redirect('/admin/dgh/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_Dgh();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;     

		$id = $this->_getParam('id');
		$dgh = Khcn_Api::_()->getItem('default_dgh', $id);
		if(!$dgh){	     
			$_SESSION['msg'] = 'Lỗi !. Dữ liệu không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/dgh/index');
		}
		
		$form->populate($dgh->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}	
		
		if($form->photo->getFileName(null,false) != null)
		{
			//determine filename and extension 
			$info = pathinfo($form->photo->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->photo->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)))
					   ->addFilter(new Khcn_Filter_File_Resize(array(
								'width' => 720,
								'height' => 720,
								'keepRatio' => true,
							)));
			$form->getValue('photo');
			
			// Remove old file
			$oldFile = $dgh->file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/dgh/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/dgh/' . $oldFile);
			
			$dgh->file = $file;
		}
		
        $values = $form->getValues();
		$dgh->setFromArray($values);
		$dgh->save();        
                
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/dgh/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$dgh = Khcn_Api::_()->getItem('default_dgh', $id);
    		if($dgh != null){
	    		$dgh->trang_thai = 1 - $status;
				$dgh->save();
	    		$this->_redirect('/admin/dgh/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/dgh/index');
    		}
    	}else{
    		$this->_redirect('/admin/dgh/index');
    	}
    }
}

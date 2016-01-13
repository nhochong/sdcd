<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_ThongTinController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $data = Khcn_Api::_()->getDbTable('thong_tin', 'default')->fetchAll(null, "ngay_tao DESC");
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
        $form = new Admin_Form_ThongTin();
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

		$table = Khcn_Api::_()->getDbTable('thong_tin', 'default');
		$thong_tin = $table->createRow();

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
			$thong_tin->file = $file;
		}

		$values = $form->getValues();
		$thong_tin->setFromArray($values);
		$thong_tin->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/thong-tin/them');					
		}else{
			$this->_redirect('/admin/thong-tin/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/thong-tin/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$thong_tin = Khcn_Api::_()->getItem('default_thong_tin', $id);
			if($thong_tin != NULL)
			{
				//xoa database
				$thong_tin->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/thong-tin/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$thong_tin = Khcn_Api::_()->getItem('default_thong_tin', $id);
    		if($thong_tin != null){	
    			$thong_tin->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/thong-tin/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/thong-tin/index');
    		}
    	}else{
    		$this->_redirect('/admin/thong-tin/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_ThongTin();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;     

		$id = $this->_getParam('id');
		$thong_tin = Khcn_Api::_()->getItem('default_thong_tin', $id);
		if(!$thong_tin){	     
			$_SESSION['msg'] = 'Lỗi !. Dữ liệu không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/thong-tin/index');
		}
		
		$form->populate($thong_tin->toArray());
		
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
			$oldFile = $thong_tin->file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_tin/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/thong_tin/' . $oldFile);

			$thong_tin->file = $file;
		}

        $values = $form->getValues();
		$thong_tin->setFromArray($values);
		$thong_tin->save();        
                
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/thong-tin/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$thong_tin = Khcn_Api::_()->getItem('default_thong_tin', $id);
    		if($thong_tin != null){
	    		$thong_tin->trang_thai = 1 - $status;
				$thong_tin->save();
	    		$this->_redirect('/admin/thong-tin/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/thong-tin/index');
    		}
    	}else{
    		$this->_redirect('/admin/thong-tin/index');
    	}
    }
}

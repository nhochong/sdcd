<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DownloadController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
        //Set the properties for the pagination
		$data = Khcn_Api::_()->getDbTable('download', 'default')->fetchAll(null, "ngay_tao DESC");
        $this->view->paginator = $paginator = Zend_Paginator::factory($data);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_Download();
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('download', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$download = $table->createRow();			
			if($form->file->getFileName(null,false) != null){
				//determine filename and extension 
				$info = pathinfo($form->file->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				$form->file->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$file, 
								"overwrite"=>true)))
						   ->addFilter(new Khcn_Filter_File_Resize(array(
								'width' => 720,
								'height' => 720,
								'keepRatio' => true,
							)));
				$form->getValue('file');
				$download->ten_file = $file;
			}
			$values = $form->getValues();
			$download -> setFromArray($values);
			$download->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/download/them');
			}else{
				$this->_redirect('/admin/download/index');
			}
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/download/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$download = Khcn_Api::_()->getItem('default_download', $id);
			if($download){
				$download->delete();
			}	
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/download/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$download = Khcn_Api::_()->getItem('default_download', $id);
    		if($download){	
				$download->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa.';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/download/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã tài liệu không tồn tại.';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/download/index');
    		}
    	}else{
    		$this->_redirect('/admin/download/index');
    	}
    }
    
	public function suaAction()
    {
    	$this->view->form = $form = new Admin_Form_Download();
		$id = $this->_getParam('id');
		$download = Khcn_Api::_()->getItem('default_download', $id);
		$form->populate($download->toArray());
		$form->removeElement('submitCon');			
		$form->submitExit->setLabel('Lưu');
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('download', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
			if($form->file->getFileName(null,false) != null)
			{
				//determine filename and extension 
				$info = pathinfo($form->file->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				
				$form->file->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$file, 
								"overwrite"=>true)))
						   ->addFilter(new Khcn_Filter_File_Resize(array(
									'width' => 720,
									'height' => 720,
									'keepRatio' => true,
								)));
				$form->getValue('file');	
				$download->ten_file = $file;
			}
			$values = $form->getValues();
			$download -> setFromArray($values);
			$download->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/download/index');
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
}

<?php

class Default_SuDiepController extends Khcn_Controller_Action_Standard
{
    public function indexAction()
    {
		// action body
		$this->view->categories = Khcn_Api::_()->getDbTable('loai_su_diep', 'default')->getParentListAssoc(false);
		$this->view->category_id = $category_id = $this->_getParam('category_id', null);
		$this->view->category = $category = null;
		
		// Check is parent
		if($category_id && ($category = Khcn_Api::_()->getItem('default_loai_su_diep', $category_id)) == null){
			return $this -> _forward('notfound', 'error', 'default');
		}
		if(!$category || ($category && $category->parent_id == 0)){
			$this->view->is_parent = true;
		}else{
			$this->view->is_parent = false;
			$this->view->parentCat =  Khcn_Api::_()->getItem('default_loai_su_diep', $category->parent_id);
		}
		
		$values = array(
			"loai_su_diep_id" => $category_id,
			"limit" => 5
		);
		
		$this->view->recentlyData = $recentlyData = Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep($values);
		$not_ids = array();
		foreach($recentlyData as $data){
			$not_ids[] = $data->getIdentity();
		}
		$values = array(
			"loai_su_diep_id" => $category_id,
			"not_ids" => $not_ids,
		);
        $remainData = Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep($values);
        $paginator = Zend_Paginator::factory($remainData);
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

    public function chiTietAction()
    {
        // action body
    	$id = $this->getRequest()->getParam('id');
        if(!empty($id)){
        	$suDiep = Khcn_Api::_()->getItem('default_su_diep', $id);
        	if($suDiep != null){
        		$suDiep->so_lan_xem++;
				$suDiep->save();
        		$this->view->su_diep = $suDiep;
				
				// Get related news
				$values = array(
					"loai_su_diep_id" => $suDiep->loai_su_diep_id,
					"not_ids" => array($suDiep->getIdentity()),
					"limit" => 5
				);
				$this->view->related_news = $related_news = Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep($values);
        	}
        	else 
        		$this->_redirect('su-diep/index');
        }else{
        	$this->_redirect('su-diep/index');
        }
    }
	
	public function loadMoreAction(){
		$this->_helper->layout->disableLayout();
		$id = $this->getRequest()->getParam('id');
        if(!empty($id)){
				$suDiep = Khcn_Api::_()->getItem('default_su_diep', $id);
				$values = array(
					"last_id" => $id,
					"loai_su_diep_id" => $suDiep->loai_su_diep_id,
					"limit" => 1
				);
				$suDieps = Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep($values);
			
				if(count($suDieps)){
					$this->view->su_diep = $suDieps[0];
					
					// Get related news
					$values = array(
						"loai_su_diep_id" => $suDiep->loai_su_diep_id,
						"not_ids" => array($suDiep->getIdentity()),
						"limit" => 5
					);
					$this->view->related_news = $related_news = Khcn_Api::_()->getDbTable('su_diep', 'default')->getDanhSachSuDiep($values);
					$this->view->no_data = false;
				}else{
					$this->view->no_data = true;
				}
        }else{
        	$this->view->no_data = true;
        }
	}
}






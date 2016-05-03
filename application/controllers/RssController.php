<?php

class RssController extends Zend_Controller_Action
{
	// -------- init action ---------------//
	public function init(){
		$this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()){
            $this->view->user=$this->auth->getIdentity();
            $this->user=$this->auth->getIdentity();
        }
            $this->model = new Application_Model_Rss();
            if($this->auth->getIdentity()){}else{$this->redirect('user/login');
        }
	}
	// ---------------- index Action -----//
	public function indexAction()
    {
        $this->redirect('Rss/list');
    }
    // ---------- Add new Rss ---------- //
    public function newAction(){
    	$data = $this->getRequest()->getParams(); // get data submitted if the request type is post
        $form = new Application_Form_Rss(); // create new form object
        if($this->getRequest()->isPost())
        {
        	// write your code to submit data here
        	$data['user_id']=$this->user->id;
            $data['id']=null;
            if($form->isValid($data))
            {
                if ($this->model->insertRss($data))
                {
                    $this->redirect('rss/index');
                }
            }

        }
        else{
        	// means get form to insert new data in it
        	// else means we need to enter new Rss Feed :)
        	$this->view->form = $form;
        }

    }
    // ---------- Delete Rss of User ----- //
    public function deleteAction(){
        $rss_id = $this->getRequest()->getParam('rssid');
        if($rss_id){
            //checkOwner($rss_id);
            if ($this->model->deleteRss($rss_id))
            $this->redirect('rss/');
        }
        else {
            $this->redirect('rss/');
        }
    }

    //---------- EditAction ---------------//
    public function editAction(){
        $rssid = $this->getRequest()->getParam('rssid');
        $data  =$this->model->selectRssById($rssid);
        $form = new Application_Form_Rss();
        if($rssid){
            $form->populate($data[0]);
        }
        $this->view->form = $form;
    }
    // ---------- List Rss of User ----- //
    public function listAction()
    {

        $user_id=$this->user->id;
        $this->view->rss = $this->model->listRss($user_id);
    }
    // -------- RssAction----------------//
    public function feedAction()
    {
			$rss_id = $this->getRequest()->getParam('rssid');
			$myRss = $this->model->selectRssById($rss_id);
			$this->view->rsstitle=$myRss[0]['name'];
			$this->view->rssdesc=$myRss[0]['description'];
			echo '<meta charset="UTF-8">';

    	$feed = Zend_Feed_Reader::import($myRss[0]['url']);
    	$data = array(
        'title'        => $feed->getTitle(),
        'link'         => $feed->getLink(),
        'dateModified' => $feed->getDateModified(),
        'description'  => $feed->getDescription(),
        'language'     => $feed->getLanguage(),
        'entries'      => array(),
    	);

    	foreach ($feed as $entry) {
        $edata = array(
            'title'        => $entry->getTitle(),
            'description'  => $entry->getDescription(),
            'dateModified' => $entry->getDateModified(),
            'authors'       => $entry->getAuthors(),
            'link'         => $entry->getLink(),
            'content'      => $entry->getContent()
        );
        $data['entries'][] = $edata;
    }
      	$this->view->rssdata=$data;
    }


}
?>

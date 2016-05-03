<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {

    }
  // ------------- Index Action -------------- //
    public function indexAction()
    {
        //On every init() of controller you have to check is authenticated or not
        $authorization = Zend_Auth::getInstance();
        if(!$authorization -> hasIdentity()) {
          $this->redirect('/user/login');
        }
        else
        {
          $userObj = $authorization->getIdentity();
          $this->redirect('/');
        }
    }

    // ------------- Registration Action -------------- //

    public function registrationAction()
    {
    	$form = new Application_Form_User();
    	$myuser = new Application_Model_User();
       	if($this->getRequest()->isGet()){
       		$this->view->form = $form;
       	}
       	// ------------ in case of submitting data -------------//
       	else
       	{
       		$data = $this->getRequest()->getParams();
       		$myuser->insertUser($data);
       	}
    }

    // ------------- Login Action -------------- //
    public function loginAction(){
      $form = new Application_Form_User();
      $authorization = Zend_Auth::getInstance();
      if($authorization -> hasIdentity()) {
        $this->redirect('/');
      }
      $data = $this->getRequest()->getParams();
      $form -> removeElement('cpassword');
      $form -> removeElement('username');
      $form -> removeElement('captcha');
      if ($this->getRequest()->isPost()){
        if($form->isValid($data)){
          $username= $this->_request->getParam('email');
          $password= $this->_request->getParam('password');
          // get the default db adapter
          $db = Zend_Db_Table::getDefaultAdapter();
          //create the auth adapter
          $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users','email', 'password');
          //set the email and password
          $authAdapter -> setIdentity($username);
          $authAdapter->setCredential(md5($password));
          //authenticate
          $result = $authAdapter->authenticate();
          //var_dump($result);
          if($result->isValid()){
            //echo ("Valid user ohooo");
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            // Return user authentication //
            $storage->write($authAdapter->getResultRowObject(array('id','username','email')));
            $this->redirect('/rss/list');
          }
        }
      }
      $this->view->form = $form;

    }
    // ------------ LogoutAction ---------------- //
    public function logoutAction(){
      // get an instance from authentication class
      $authorization = Zend_Auth::getInstance();
      if(!$authorization -> hasIdentity()) {
        $this->redirect('/user/login');
      }
      else
      {
        $authorization->clearIdentity();
        $this->redirect('/user/login');

      }
    }
//-----------------------------------------------------
}

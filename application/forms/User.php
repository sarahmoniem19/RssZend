<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
      $id = new Zend_Form_Element_Hidden("id");
      $this->setMethod('post');
      $this->setAttrib('class','form-inline');
      $name = $this->addElement(
            'text', 'username', array(
                'label' => 'Username:',
                'required' => true,
                'filters'    => array('StringTrim'),
                'class' =>'form-control',
                'size'  => '30',
            ));

        // --------------- Email --------------------//
      $email= $this->addElement(
            'text', 'email', array(
                'label'    => 'Email:',
                'required' => true,
                'filters'  => array('StringTrim'),
                'class' =>'form-control',
                'size'  => '30',
            ));
 		  // ------------- Password ------------------//
      $password = $this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
            'class' =>'form-control',
            'size'  => '30',
            ));
      // $password->setAttrib("class","col-sm-6");
        // -------- Confirm Password ---------------//
      $this->addElement('password', 'cpassword', array(
            'label' => 'Confirm Password:',
            'required' => true,
            'class'    => 'form-control',
            'size'  => '30',
            ));

 		//--------- Submit -------------------------//
      $submit = $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            'class'    => 'btn btn-success',
            ));
        // ---------- Adding Captcha ---------------//
    // $captcha = $this->addElement('captcha','captcha',
    // 	array(
    // 		'label'=>'Ensure that you are not a robot',
    // 		'required'=>true,
    // 		'captcha'=>array(
    // 			'captcha'=>'Figlet',
    // 			'wordLen'=>6,
    // 			'timeout'=>200,
    // 			),
    // 		)
    // 	);

        //---------------- add Elements -------------------//
      $this->addElements(array($id,$name,$email, $password, $submit));
    }



}

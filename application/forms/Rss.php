<?php

class Application_Form_Rss extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $id = new Zend_Form_Element_Hidden("id"); // create new hidden id
        $name = new Zend_Form_Element_Text("name");
        $name->setRequired();
        $name->setlabel("Name:");
        $name->setAttrib("class","form-control","col-lg-9");
        $name->setAttrib("placeholder","");
        //---------- url field -------------- //
        $url = new Zend_Form_Element_Text("url");
        $url->setRequired();
        $url->setlabel("Url:");
        $url->setAttrib("class","form-control");
        $url->setAttrib("placeholder","");
        // -------- Description field ------- //
        $description = new Zend_Form_Element_Text("description");
        $description->setRequired();
        $description->setlabel("Description:");
        $description->setAttrib("class","form-control","col-lg-9");
        $description->setAttrib("placeholder","Write Description  ...");
        // -------- Submit Field ----------- //
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','btn btn-success');
        $this->addElements(array($id,$name,$url,$description,$submit));


    }


}

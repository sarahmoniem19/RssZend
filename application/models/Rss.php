<?php

class Application_Model_Rss extends Zend_Db_Table_Abstract
{
	protected $_name = 'rss';

	// ----------- Create Rss --------------//
	public function insertRss($data){
		$rss_row = $this->createRow();
		$rss_row->name        = $data['name'];
		$rss_row->description = $data['description'];
		$rss_row->url         = $data['url'];
		$rss_row->user_id     = $data['user_id'];
		$rss_row->created_at  = $data['created_at'];
		$rss_row->modified_at = $data['modified_at'];
		return $rss_row->save();
	}
	// ----------- List Rss --------------//
	public function listRss($user_id){
		$db = Zend_Db_Table::getDefaultAdapter();
		//---- Create a new select object ----//
		$select    = new Zend_Db_Select($db);
		//---- implement select statement ----//
		$select->from('rss')->where('user_id = ?', $user_id);
		$result    = $select->query();
		$resultSet = $result->fetchAll();
		//$res_array = $resultSet->toArray();
		return $resultSet;
	}
	// ----------- getRssById --------------//
	public function selectRssById($rss_id){
		return $this -> find($rss_id) -> toArray();
	}
	//-------- Edit Rss -------------------//
	public function editRss($rssId, $data){
		$mydata = array(
			'name' => $data['name'],
            'description' => $data['description'],
            'url' => $data['url']
			);
		$where = "id = " . $id;
        return $this->update($mydata, $where);

	}

	//-------- Delete Rss ----------------// 
	public function deleteRss($rssId){
		return $this -> delete('id='.$rssId);
	}


}



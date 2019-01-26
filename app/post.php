<?php

class Post {

  public $id;

	// Post text
	public $text;

	// Time of post
	public $time;

	// User Id of the user who posted
	public $by;

	// Number of likes
	public $likes_no;

	// Number of comments
	public $comments_no;

	//##################### Accessor and Mutator Methods #########################
    
    public function getId() {
      return $this->id;
    }
  
    public function setId($id) {
        $this->id = $id;
    } 

  	public function getText() {
    	return $this->text;
  	}
  
  	public function setText($msg) {
  	  	$this->text = $msg;
  	}

  	public function getPostby() {
    	return $this->by;
  	}
  
  	public function setPostby($msg) {
  	  	$this->by = $msg;
  	}

  	public function getTime() {
    	return $this->time;
  	}
  
  	public function setTime($msg) {
  	  	$this->time = $msg;
  	}

  	public function getLikes_no() {
    	return $this->like_no;
  	}
  
  	public function setLikes_no($msg) {
  	  	$this->like_no = $msg;
  	}

  	public function getComments_no() {
    	return $this->comments_no;
  	}
  
  	public function setComments_no($msg) {
  	  	$this->comments_no = $msg;
  	}
  
  //##################### End of Accessor and Mutator Methods ##################
  
  /* Set's the details of the post from the query result into the 
   * current post object instance.
   * @param array $row
   * @param mysqli $dbCon
   */
  public function arrToPost($row, $dbCon) {
    if (!empty($row)) {
      if (isset($row['by']) && isset($row['text'])) {
        // Fetch the user details and create the user object set.
        $resultObj = $dbCon->query('SELECT * FROM `users` WHERE `users`.`user_id`=' . $row['by']);
        
        $usersArr = array();
        while($record = $resultObj->fetch_assoc()) {
          $usersArr[] = $record;
        }
        
        $by = new User();
        $by->arrToUser($usersArr[0]);

        $this->setPostby($by);
      }

      isset($row['id']) ? $this->setId($row['id']) : '';
      isset($row['text']) ? $this->setText($row['text']) : '';
      isset($row['timestamp']) ? $this->setTime($row['timestamp']) : '';
      isset($row['likes_no']) ? $this->setLikes_no((int)$row['likes_no']) : '';
      isset($row['comments_no']) ? $this->setComments_no((int)$row['comments_no']) : '';
    }
  }

  public function postToJson(){
  	$ret = array();
    $ret['id'] = $this->id;
  	$ret['text'] = $this->text;
  	$ret['time'] = $this->time;
  	$ret['by_name'] = $this->getPostby()->getName();
  	$ret['by_id'] = $this->getPostby()->getUserId();
  	$ret['likes_no'] = $this->like_no;
  	$ret['comments_no'] = $this->comments_no;

  	return json_encode($ret);  	
  }

  public function postToArr(){
    $ret = array();
    $ret['id'] = $this->id;
    $ret['text'] = $this->text;
    $ret['time'] = $this->time;
    $user = new User();
    $user = $this->getPostby();
    $ret['by_name'] = $user->getName();
    $ret['by_id'] = $user->getUserId();
    $ret['likes_no'] = $this->like_no;
    $ret['comments_no'] = $this->comments_no;

    return $ret;   
  }

}
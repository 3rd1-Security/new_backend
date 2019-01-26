<?php 

class Feed {
	/**
   * The user who is currently logged in
   * @var User
   */
  private $loggedInUser;
  
  /**
   * Database connection
   * @var mysqli
   */
  private $dbCon;
  
  /**
   * @param mysqli $dbCon
   * @param User $loggedInUser
   * @return boolean|Relation
   */
  public function __construct($dbCon, User $loggedInUser) {
    if ($dbCon == 'undefined') {
      return false; 
    }
    // Current loggedin user
    $this->loggedInUser = $loggedInUser;
    // Database Connection
    $this->dbCon = $dbCon;
  }
    
  /**
   * Return the unseen posts of the current logged in user posted by friends
   * @param Relationship $rel
   * @return Post $posts
   */
  public function getFeed_json($start = 0, $limit = 2000) {
    $id = (int)$this->loggedInUser->getUserId();
    
    $relation = new Relation($this->dbCon, $this->loggedInUser);
    $rels = $relation->getFriendsList();
    $friends = array();
    foreach ($rels as $key=>$value) {
    	$friends[] = $relation->getFriend($rels[$key]);
    }
    
    $ret = array();

    if(!empty($following)){
      $sql = 'SELECT * FROM `feeds` WHERE `by` IN ('. implode(', ', $friends) .', '. $id .') ORDER BY timestamp DESC LIMIT '
        . $limit . ' OFFSET '. $start;
    } else {
      $sql = 'SELECT * FROM `feeds` WHERE `by` IN ('. $id .') ORDER BY timestamp DESC LIMIT '
        . $limit . ' OFFSET '. $start;
    }

    $resultObj = $this->dbCon->query($sql);
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = new Post();
      $rel->arrToPost($row, $this->dbCon);
      $ret[] = $rel->postToArr();
    }

    return $ret;
  }
  
  /**
   * Return the unseen posts of the current logged in user posted by friends
   * @param Relationship $rel
   * @return json ret
   */
  /*public function getFeed_json($start = 0, $limit = 2000) {
    $id = (int)$this->loggedInUser->getUserId();

    $follow = new Follow($this->dbCon, $this->loggedInUser);
    $followship = $follow->getFollowingList();
    $following = array();
    foreach ($followship as $key=>$value) {
    	if($temp=$follow->getFollower($followship[$key])){
        $following[$key] = $temp; 
      }
    }

    $ret = array();

    if(!empty($following)){
	    $sql = 'SELECT * FROM `feeds` WHERE `by` IN ('. implode(', ', $following) .', '. $id .') ORDER BY timestamp DESC LIMIT '
    		. $limit . ' OFFSET '. $start;
    } else {
    	$sql = 'SELECT * FROM `feeds` WHERE `by` IN ('. $id .') ORDER BY timestamp DESC LIMIT '
    		. $limit . ' OFFSET '. $start;
    }

    $resultObj = $this->dbCon->query($sql);
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = new Post();
      $rel->arrToPost($row, $this->dbCon);
      $ret[] = $rel->postToArr();
    }

    return $ret;
  }*/
  
  /**
   * Get all the friends list for the currently loggedin user
   * @return array Relationship Objects
   */
  public function searchFeed($keyword, $start = 0, $limit = 1000) {
    $id = (int)$this->loggedInUser->getUserId();
    
    $all_posts = new Post();
    $all_posts = $this->getFeed($start, $limit);

    $filtered_posts = array();
    $filter_pos = array();

    foreach ($all_posts as $key => $value) {
    	if($pos = stripos($all_posts[$key]->getMessage(), $keyword)) {
    		$filtered_posts[] = $all_posts[$key];
    		$filter_pos[] = $pos;
    	}
    }

    $result = array();
    $result['posts'] = $filtered_posts;
    $result['position'] = $filter_pos;

    return $filtered_posts;
  }

  /**
   * Comment on the post logged in user wants to
   * @param Post object
   * @return array comments details
   */
  public function Comment_post(Post $post, $text) {
  	$id = (int)$this->loggedInUser->getUserId();
    $feed_id = $post->getPostby()->getUserId();

    $sql = 'INSERT INTO `posts_comments`(`feed_id`,`comment`,`comm_by`) VALUES('. $feed_id .', "'. $text .'", '. $id .')';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {
      
      	$sql = 'UPDATE `feeds` SET comments_no = comments_no+1 WHERE id = '. $feed_id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    return false;
  }
  
  public function Like_post(Post $post) {
  	$id = (int)$this->loggedInUser->getUserId();
    $feed_id = $post->getPostby()->getUserId();
    $name = $this->loggedInUser->getName();
    
    $sql = 'INSERT INTO `posts_likes`(`feed_id`,`by_id`,`by_name`) VALUES('. $feed_id .', '. $id .', "'. $name .'")';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {

    	$sql = 'UPDATE `feeds` SET likes_no = likes_no+1 WHERE id = '. $feed_id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    return false;
  }

  /**
   * Make post logged in user wanrs to
   * @param text
   * @return array comments details
   */
  public function MakePost($text) {
  	$id = (int)$this->loggedInUser->getUserId();
    
    $sql = 'INSERT INTO `feeds`(`text`,`by`) VALUES("'. $text .'", '. $id .')';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {
      	return true;
    }
    
    return false;
  }

  /**
   * Comment on the post logged in user wants to
   * @param Post object
   * @return array comments details
   */
  public function Comment($feed_id, $text) {
  	$id = (int)$this->loggedInUser->getUserId();
    
    $sql = 'INSERT INTO `posts_comments`(`feed_id`,`comment`,`comm_by`) VALUES('. $feed_id .', "'. $text .'", '. $id .')';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {
      
      	$sql = 'UPDATE `feeds` SET comments_no = comments_no+1 WHERE id = '. $feed_id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    return false;
  }
  
  public function Like($feed_id) {
  	$id = (int)$this->loggedInUser->getUserId();
    $name = $this->loggedInUser->getName();

    $feedandby = $feed_id. "." .$id;
    
    $sql = 'INSERT INTO `posts_likes`(`feed_id`,`by_id`,`by_name`,`feedandby`) VALUES('. $feed_id .', '. $id .', "'. $name .'", "'. $feedandby .'")';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {
    	$sql = 'UPDATE `feeds` SET likes_no = likes_no+1 WHERE id = '. $feed_id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		return 1;
    	} else {
    		return 0;
    	}
    }else if($this->dbCon->affected_rows==-1 && $this->dbCon->errno==1062) {
    	$sql = 'DELETE FROM `posts_likes` WHERE `feed_id`='. $feed_id .' AND `by_id`='. $id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		$sql = 'UPDATE `feeds` SET likes_no = likes_no-1 WHERE id = '. $feed_id;
    		$this->dbCon->query($sql);
    		if($this->dbCon->affected_rows > 0) {
    			return 2;
    		}
    	}

    	return 0;
    }
    
    return 0;
  }

  /**
   * Get the list of comments on the post logged in user wants to see
   * @param Post object
   * @return array comments details
   */
  public function seeComments_post(Post $post) {
    $feed_id = $post->getPostby()->getUserId();

    $sql = 'SELECT * FROM `posts_comments` WHERE ' . 
            '`feed_id` = ' . $feed_id;
            
    $resultObj = $this->dbCon->query($sql);
    
    $rels = array();
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = array();
      $rel['comment'] = $row['comment'];
      $rel['likes'] = $row['likes'];
      $rel['comm_by'] = $row['comm_by'];
      $rel['timestamp'] = $row['timestamp'];
      $rels[] = $rel;
    }
    
    return $rels;
  }

  /**
   * Get the list of comments on the post logged in user wants to see
   * @param Post id
   * @return array comments details
   */
  public function seeComments_id($feed_id) {
    $sql = 'SELECT * FROM `posts_comments` WHERE ' . 
            '`feed_id` = ' . $feed_id;
            
    $resultObj = $this->dbCon->query($sql);
    
    $rels = array();
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = array();
      $rel['comment'] = $row['comment'];
      $rel['likes'] = $row['likes'];
      $rel['comm_by'] = $row['comm_by'];
      $rel['timestamp'] = $row['timestamp'];
      $rels[] = $rel;
    }
    
    return $rels;
  }
  
  /**
   * Get the list of comments on the post logged in user wants to see
   * @param Post object
   * @return array comments details
   */
  public function seeLikes_post(Post $post) {
    $feed_id = $post->getPostby()->getUserId();

    $sql = 'SELECT * FROM `posts_likes` WHERE ' . 
            '`feed_id` = ' . $feed_id;
            
    $resultObj = $this->dbCon->query($sql);
    
    $rels = array();
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = array();
      $rel['by_id'] = $row['by_id'];
      $rel['by_name'] = $row['by_name'];
      $rel['timestamp'] = $row['timestamp'];
      $rels[] = $rel;
    }
    
    return $rels;
  }

  /**
   * Get the list of comments on the post logged in user wants to see
   * @param Post id
   * @return array comments details
   */
  public function seeLikes_id($feed_id) {
    $sql = 'SELECT * FROM `posts_likes` WHERE ' . 
            '`feed_id` = ' . $feed_id;
            
    $resultObj = $this->dbCon->query($sql);
    
    $rels = array();
    
    while($row = $resultObj->fetch_assoc()) {
      $rel = array();
      $rel['by_id'] = $row['by_id'];
      $rel['by_name'] = $row['by_name'];
      $rel['timestamp'] = $row['timestamp'];
      $rels[] = $rel;
    }
    
    return $rels;
  }
}
<?php
session_start();
include_once '../app/config.php'

function SQLInjFilter(&$unfilteredString){
	$unfilteredString = mb_convert_encoding($unfilteredString, 'UTF-8', 'UTF-8');
	$unfilteredString = htmlentities($unfilteredString, ENT_QUOTES, 'UTF-8');
	// return $unfilteredString;
}
$error = "";
$return = "";
$status = 0;
$ret = array();

$feed_id = $_GET['feed_id'];

if (!isset($feed_id) || $feed_id=='') {
	$error .= "Feed invalid.";
    $status = 400;
}

if($status!=400){
	$sql = 'INSERT INTO `posts_likes`(`feed_id`,`by_id`,`by_name`,`feedandby`) VALUES('. $feed_id .', '. $id .', "'. $name .'", "'. $feedandby .'")';
            
    $this->dbCon->query($sql);
    
    if($this->dbCon->affected_rows > 0) {
    	$sql = 'UPDATE `feeds` SET likes_no = likes_no+1 WHERE id = '. $feed_id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		
    	} else {
    		
    	}
    }else if($this->dbCon->affected_rows==-1 && $this->dbCon->errno==1062) {
    	$sql = 'DELETE FROM `posts_likes` WHERE `feed_id`='. $feed_id .' AND `by_id`='. $id;
    	$this->dbCon->query($sql);
    	if($this->dbCon->affected_rows > 0) {
    		$sql = 'UPDATE `feeds` SET likes_no = likes_no-1 WHERE id = '. $feed_id;
    		$this->dbCon->query($sql);
    		if($this->dbCon->affected_rows > 0) {
    		}
    	}
    }
	if($out==1){	
		$ret['status'] = 200;
		$ret['message'] = "Liked";
	}elseif($out==2){
		$ret['status'] = 202;
		$ret['message'] = "Unliked";
	}else{
		$ret['status'] = 500;
		$ret['err'] = "Could not fetch data...";
	}	
}else{
	$ret['status'] = 400;
	$ret['err'] = "Invalid text";
}

?>

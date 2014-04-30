<?php

function getStoryList()
{
	
	$storyList = array();
	$storyList[]= array('title'=>'Good Tale 1', "storyID"=>'123456anb1', 'creator'=>"Billy123");
	$storyList[]= array('title'=>'Good Tale 2', "storyID"=>'123456anb2', 'creator'=>"Billy12");
	$storyList[]= array('title'=>'Good Tale 3', "storyID"=>'123456anb3', 'creator'=>"Billy1");
	$storyList[]= array('title'=>'Good Tale 4', "storyID"=>'123456anb4', 'creator'=>"Billy23");
	$storyList[]= array('title'=>'Good Tale 5', "storyID"=>'123456anb5', 'creator'=>"Kevin123");
	$storyList[]= array('title'=>'Good Tale 6', "storyID"=>'123456anb6', 'creator'=>"Kevin123");
	$storyList[]= array('title'=>'Good Tale 7', "storyID"=>'123456anb7', 'creator'=>"Kevin123");
	$storyList[]= array('title'=>'Good Tale 8', "storyID"=>'123456anb8', 'creator'=>"Kevin1");
	$storyList[]= array('title'=>'Good Tale 9', "storyID"=>'123456anb9', 'creator'=>"Billy2");
	$storyList[]= array('title'=>'Good Tale 10', "storyID"=>'123456anb10', 'creator'=>"Billy3");
	$dummy = array('storyList'=>$storyList);
	return json_encode($dummy);
}

function getStory($storyID)
{
	$contribList=array();
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"What a pity you're so poky! Now the strawberry shortcake is all gone!", "img"=>"", "contID"=>'123456anb1', 'creator'=>"Billy123");
	$contribList[]= array('text'=>"", "img"=>"http://www.w3schools.com/w3frontimage.png", "contID"=>'123456anb1', 'creator'=>"Billy123");
	
	$story = array('story'=>array('title'=>'Good Tale1', 'creator'=>'oneBadMutha4568794635', 'contribList'=> $contribList));
	

	return json_encode($story);
}

function getContribution($contID)
{
	if($contID%2==0)
		$contrib = array( 'contrib'=> array( 'text'=>'Hello dude', 'image'=>'', 'user'=>'billyssister' ) );
	else
		$contrib = array( 'contrib'=> array( 'text'=>'', 'image'=>'http://www.w3schools.com/w3frontimage.png', 'user'=>'billyssister' ) );
		
	return json_encode($contrib);
		
}

function setContribution($text, $creator, $storyID)
{
	
	if($text == "")
	{
		//must be a image contrib lets check
		if(count($_FILES) <= 0)
			return json_encode( array('status'=>'error', 'msg'=>'No file or text in contribution.') );
		
		return json_encode( array('status'=>'ok', 'msg'=>'', 'contID'=>'1234567') );
	}
	else
	{
		//must be a text contrib
		if(strlen($text) <= 150)
			return json_encode( array('status'=>'ok', 'msg'=>'') );
		else
			return json_encode( array('status'=>'error', 'msg'=>'text submission is too large') );
	}
}

function newStory($title, $creator, $text)
{
	if(strlen($title) <=0 or strlen($creator) <=0 or strlen($text) <=0)
		return json_encode( array('status'=>'error', 'msg'=>'invalid parameters') );
	return json_encode( array('status'=>'ok', 'msg'=>'', 'storyID'=>'465asdfe') );
}

function switchFunction()
{
	switch($_GET['func'])
	{
		case 'storyList':
			print getStoryList();
			break;
		case 'getStory':
			print getStory($_GET['storyID']);
			break;
		case 'getContrib':
			print getContribution($_GET['contID']);
			break;
		case 'setContrib':
			print setContribution($_GET['text'], $_GET['user'], $_GET['storyID']);
			break;
		case 'newStory':
			print newStory($_GET['title'], $_GET['user'], $_GET['text']);
			break;
		default:
			print "Error:Undefined Function.";
	}
}

//Main
switchFunction();

?>

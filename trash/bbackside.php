<?php

$dbserver='localhost';
$dbuser='sirmixalot';
$dbpasswd='bigandround00';
$dbname='ExquisiteTale';

#function creates necessary tables for the data to live only run once by hand
#this will delete everything in database when run!!!
function buildDatabaseAndTables() 
{
	global $argv;
	global $dbserver;
	global $dbuser;
	global $dbpasswd;
	global $dbname;
	
	
	if(count($argv) != 4)
	{
		print 'bbackside.php $server $rootuser $passwd ';
		return;
	}
	
	$dbserver=$argv[1];
	$dbrootuser=$argv[2];
	$dbrootpasswd=$argv[3];
	
	$mysqli = new mysqli($dbserver, $dbrootuser, $dbrootpasswd);
	if ($mysqli->connect_errno)
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return; 
	}
	
	//Create database
	$mysqli->query("DROP DATABASE IF EXISTS $dbname");
	if (!$mysqli->query("CREATE DATABASE $dbname") )
	{
		echo 'Error creating database: (' . $mysqli->errno .") msg: ". $mysqli->error . "\n";
		return;
	}
	
	echo "Database created\n";
	
	//Create database user
	if (!$mysqli->query("GRANT ALL PRIVILEGES ON $dbname.* TO '$dbuser'@'$dbserver' IDENTIFIED BY '$dbpasswd'"))
	{
		echo 'Error adding user for database: (' . $mysqli->errno .") msg: ". $mysqli->error . "\n";
		return;
	}
	
	echo "database User created\n";
	$mysqli->close();
	
	#connecting as newly created user
	$mysqli = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);
	if ($mysqli->connect_errno)
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return; 
	}
	echo "Connected as newly created user.\n";
	
	//Create Tables
	if ( !$mysqli->query("CREATE TABLE Stories(storyID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, title VARCHAR(150), creator VARCHAR(50))") )
	{
		echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	if ( !$mysqli->query("CREATE TABLE Contributions(contID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, storyID INT UNSIGNED , user VARCHAR(50), txt VARCHAR(300))") )
	{
		echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	echo "All Tables Created\n";
	$mysqli->close();
}
function getDBconn()
{
	global $dbserver;
	global $dbuser;
	global $dbpasswd;
	global $dbname;
	
	#connecting to db
	$mysqli = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);
	if ($mysqli->connect_errno)
		return json_encode( array('status'=>'error'.$mysqli->errno, 'msg'=>$mysqli->error) );
	return $mysqli;
}
function getStoryList()
{
	$mysqli = getDBconn();
	
	if ($result = $mysqli->query("SELECT * FROM Stories")) {
		printf("Select returned %d rows.\n", $result->num_rows);
		
		$storyList = array();	
		
		while($row = $result->fetch_assoc())
		{
			$storyList[]= array( "storyID"=>$row['storyID'], 'title'=>$row['title'],  'creator'=>$row['creator']);
		}
		
		$result->close();
		return json_encode(array('storyList'=>$storyList, 'status'=>'ok'));
	}
	else
		return json_encode( array('status'=>'error'.$mysqli->errno, 'msg'=>$mysqli->error) );
}

function getStory($storyID)
{
	$mysqli = getDBconn();
	
	if ($result = $mysqli->query("SELECT * FROM Stories WHERE storyID='$storyID'"))
	{
		if($result->num_rows <= 1)
		{
			$storyrow = $result->fetch_assoc();
		}
		else
			return json_encode( array('status'=>'error', 'msg'=>"storyID not unique!") );
	}
			
	//now lets fetch the contributions
	$contribList = array();	
	if($result = $mysqli->query("SELECT * FROM Contributions WHERE storyID='$storyID'"))
	{
		
		
		while($row = $result->fetch_assoc())
		{
			$contribList[]= $row;//array( "storyID"=>$row['storyID'], 'title'=>$row['title'],  'creator'=>$row['creator']);
		}
		$result->close();
	}
	else
		return json_encode( array('status'=>'error'.$mysqli->errno, 'msg'=>$mysqli->error) );
	
	
	$story = array('story'=>array( 
								"storyID"=>$storyrow['storyID'], 
								'title'=>$storyrow['title'], 
								'creator'=>$storyrow['creator'], 
								'contribList'=> $contribList), 'status'=>'ok');
	
	$result->close();
	return json_encode($story);
}

function getContribution($contID)
{
	if($contID%2 == 0)
		$contrib = array( 'contrib'=> array( 'text'=>'Hello dude', 'image'=>'', 'user'=>'billyssister' ) );
	else
		$contrib = array( 'contrib'=> array( 'text'=>'', 'image'=>'http://www.w3schools.com/w3frontimage.png', 'user'=>'billyssister' ) );
		
	return json_encode($contrib);
		
}

function setContribution($text, $creator, $storyID)
{
	$mysqli = getDBconn();
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
		{
			if ($result = $mysqli->query("INSERT INTO Contributions 
										(contID, storyID, user, txt)
										VALUES (null,'$storyID','$creator', '$text')"))
			{
				$contID = $mysqli->insert_id;
				return json_encode( array('status'=>'ok', 'msg'=>'','contID'=>$contID) );
			}
			else
			return json_encode( array('status'=>'error'.$mysqli->errno, 'msg'=>$mysqli->error) );
		}
		else
			return json_encode( array('status'=>'error', 'msg'=>'text submission is too large') );
	}
	$mysqli->close();
}

function newStory($title, $creator, $text)
{
	if(strlen($title) <=0 or strlen($creator) <=0 or strlen($text) <=0)
		return json_encode( array('status'=>'error', 'msg'=>'invalid parameters') );
	$mysqli = getDBconn();
	
	if ($result = $mysqli->query("INSERT INTO Stories 
										(storyID, title, creator)
										VALUES (null,'$title','$creator')"))
	{
		$storyID = $mysqli->insert_id;
		$ret = json_decode(setContribution($text, $creator, $storyID), true);
		print_r($ret);
		if($ret['status'] == 'ok')
			return json_encode( array('status'=>'ok', 'msg'=>'', 'storyID'=>$storyID, 'contID'=>$ret['contID']) );
	}
	else
		return json_encode( array('status'=>'error'.$mysqli->errno, 'msg'=>$mysqli->error) );
	$mysqli->close();
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
if(php_sapi_name() == 'cli')
	buildDatabaseAndTables();
else
	switchFunction();

?>

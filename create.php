
<?php
echo "Thank you for contributing to Exquisite Tale!";
$title = $_POST['title'];
$cont = $_POST['text_contribution'];
$user = $_POST['user'];

echo "Title ". $title . "<br />"; 
echo "Text Contribution " . $cont  . "<br />";

// CREATE FILENAME
$datetime = date('Y-m-d H:i:s') ;
$datetime = preg_replace('/[-:\s]/', '', $datetime);
$new_file = "tale".$datetime.".json";
echo "Filename: " . $new_file;
$my_file = $new_file;

// CREATE FILE
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file

// CREATE JSON OBJECT
$named_array = array(

"story" => array(

	"title" => $title,
	"creator" => $user,
    "contribList" => array(
        array(
            "text" => $cont,
            "image" => "",
            "contID" => "baz2",
            "user" => $user
        )
    )
)
);

// PUT JSON IN FILE
file_put_contents($my_file, json_encode($named_array));

// NOW PUT THE NEW STUFF IN THE TITLES LIST
$file = "titles.json";
$json = json_decode(file_get_contents($file));

$storyID = "tale".$datetime;
$info = array("title" => $title, "storyID" => $storyID, "user" => $user);
array_push($json->storyList, $info);

file_put_contents($file, json_encode($json));

?>


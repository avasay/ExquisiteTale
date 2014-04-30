<?php 

$text = $_POST['text_contribution'];
$image = $_POST['image'];
$contID = $_POST['contID'];
$user = $_POST['user'];

$file = $_POST['filename'];
$json = json_decode(file_get_contents($file));


$info = array("text" => $text, "image" => $image, "contID" => $contID, "user" => $user);
array_push($json->story->contribList, $info);
file_put_contents($file, json_encode($json));

$chunks = explode (".", $file);
$storyID= $chunks[0];

echo '<h1>Thank you for your contribution! </h1>';
echo '<h2> <a href="slideshow.php?storyID='. $storyID . '">Watch it added in the slideshow! </a></h2>';
echo '<meta http-equiv="refresh" content="3;url=slideshow.php?storyID='. $storyID . '">';

?>
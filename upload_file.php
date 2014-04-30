<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 900000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Stored in: " . $_FILES["file"]["tmp_name"];
    
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("img/" . $_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "img/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "img/" . $_FILES["file"]["name"];
    }
	
  }
} else {
  echo "Invalid file";
}

$text = $_POST['text_contribution'];
$image = "img/" . $_FILES["file"]["name"];
$contID = $_POST['contID'];
$user = $_POST['user'];

$file = $_POST['filename'];
$json = json_decode(file_get_contents($file));
echo '<br>output:</br>';
echo '<br>filename:</br>'.$file;

$info = array("text" => $text, "image" => $image, "contID" => $contID, "user" => $user);
array_push($json->story->contribList, $info);
file_put_contents($file, json_encode($json));

$chunks = explode (".", $file);
$storyID= $chunks[0];

echo '<h1>Thank you for your contribution! </h1>';
echo '<h2> <a href="slideshow.php?storyID='. $storyID . '">Watch it added in the slideshow! </a></h2>';
echo '<meta http-equiv="refresh" content="3;url=slideshow.php?storyID='. $storyID . '">';

?>

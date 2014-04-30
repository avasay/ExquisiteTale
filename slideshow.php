<?php
include("header.php");
$id = $_GET["storyID"];
echo "<script>";
echo "var id =" . "'" . $id . "'";
echo "</script>";
       
?>

<div id="et-carousel-id"></div>
      <div class="et-carousel-container" >
      	<h1 class="et-hero" id="et-slide-title"></h1>
		<div class="et-slide-show">
			<div id="myCarousel" class="carousel slide">
				<div class="et-indicators">
	                <ol class="carousel-indicators" id="et-indicator">
	                  <script>
	                  	var filename = id + ".json";
	                  	//console.log("Filename: ");
	                  	//console.log(filename);
		      			setup_slideshow_indicator(filename);
		      			setup_slideshow_main(filename);
                  	</script>
	                </ol>
                </div>
                <div class="carousel-inner" id="et-slide-inner">
                  
                  <script>
                  		
	      			
                  </script>
                  
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
              </div>
		</div>
		
		<h1 class="et-hero et-slide-contribute"><a class="btn" id="contribute-btn" href="#">Contribute To Tale &raquo;</a></h1>
		
		</div> <!-- et-carousel-container div  -->
      
<?php
include("footer.php");
?>


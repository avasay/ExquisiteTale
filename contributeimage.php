<?php
include("header.php");

$id = $_GET["filename"];
echo "<script>";
echo "var id =" . "'" . $id . "'";
echo "</script>";
       
	   
?>

<a id="contribute-image-delete"></a>
      <div class="et-individual-content-box" id="et-contribution-image">
      	<h2 class="featurette-heading">Contribute Image
      			<span class="et-muted"> Draw or Upload a Picture Based on The Following Text</span>
      	</h2>
      	<div id="et-text-previous">
	    	<script>
	    		getLastTxt(id);
	    	</script>
	    </div>
			    
      	<div id="et-image-contribution-box">
      		<div class="tools">
				    	
			  	<a href="#myCanvas" data-download="png" style="float: right; width: 100px;">Download</a>
			  	<a href="#myCanvas" data-color="#f00" style="width: 10px; background: #f00;"></a> <a href="#myCanvas" data-color="#ff0" style="width: 10px; background: #ff0;"></a> <a href="#myCanvas" data-color="#0f0" style="width: 10px; background: #0f0;"></a> <a href="#myCanvas" data-color="#0ff" style="width: 10px; background: #0ff;"></a> <a href="#myCanvas" data-color="#00f" style="width: 10px; background: #00f;"></a> <a href="#myCanvas" data-color="#f0f" style="width: 10px; background: #f0f;"></a> <a href="#myCanvas" data-color="#000" style="width: 10px; background: #000;"></a> <a href="#myCanvas" data-color="#fff" style="width: 10px; background: #fff;"></a> <a href="#myCanvas" data-size="3" style="background: #ccc">3</a> <a href="#myCanvas" data-size="5" style="background: #ccc">5</a> <a href="#myCanvas" data-size="10" style="background: #ccc">10</a> <a href="#myCanvas" data-size="15" style="background: #ccc">15</a>	<a href="#myCanvas" data-size="30" style="background: #ccc">30</a> 
			  	
			</div>
	    	<canvas id="myCanvas" width="800" height="400" style="border:1px solid #000000;">
			Your browser does not support the HTML5 canvas tag.
			</canvas>
			    
      	</div>
      	
      	<form role="form" action="upload_file.php" method="post" enctype="multipart/form-data" >
			  <div class="form-group">
			    <div id="et-image-contribution-box">
			    	
				    <div class="form-group pull-left">
				      <label for="inputfile">Insert Image (must be less than 500KB)</label>
				      <input type="file" name="file" id="file">
				      	<input type="hidden" name="user" value="kitty2">
			    		<input type="hidden" name="contID" value="12345xxxx1">
			    		<input type="hidden" name="text_contribution" value="">
			    		<input id="hidden_filename" type="hidden" name="filename" value="">
				    </div>
				    <button type="submit" class="btn btn-default pull-right">Submit</button>
			    </div>
			  </div>
		</form>
      </div>
      
<?php
include("footer.php");
?>


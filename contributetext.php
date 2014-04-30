<?php
include("header.php");

$id = $_GET["filename"];
echo "<script>";
echo "var id =" . "'" . $id . "'";
echo "</script>";

?>

<a id="contribute-text-delete"></a>
      <div class="et-individual-content-box" id="et-contribution-text">
      	<h2 class="featurette-heading">Contribute Text
	  			<span class="et-muted"> Based on this image, say what happens next in the text box provided.</span>
	  	</h2>
      	<form role="form" action="add_text.php" method="post">
	  		
			<div class="form-group">
				<div id="et-image-previous">
					<img id="et-contribute-last-text" src="" alt="">
					<script>
						getLastImg(id);
					</script>
			    </div>
			    <div id="et-text-contribution-box">
			    	<textarea id="text_contribution" name="text_contribution" class="form-control" rows="10" ></textarea>
			    	<input type="hidden" name="user" value="bulldog1">
			    	<input type="hidden" name="contID" value="123456anc4">
			    	<input type="hidden" name="image" value="">
			    	<input id="hidden_filename" type="hidden" name="filename" value="">
			    </div>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
      </div>
      
<?php
include("footer.php");
?>


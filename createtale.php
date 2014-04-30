<?php
include("header.php");
?>

<a id="create-new-tale"></a>
      <div class="et-individual-content-box" id="et-create-new">
      	<h2 class="featurette-heading">Create A New Tale
	  			<span class="et-muted"> Be forewarned. What you are about to write will be distorted and mutated by people after you. </span>
	  		</h2>
      	<form class="form-horizontal" role="form" action="create.php" method="post">
		   <div class="form-group">
		      <input type="hidden" id="user" name="user" value="balsam123">
		      <div class="col-sm-10">
		         <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
		      </div>
		   </div>
		   <div class="form-group"> 
		   	<textarea id="text_contribution" name="text_contribution" class="form-control" rows="10" placeholder="Enter initial storyline"></textarea>
		 	</div>
		   <button type="submit" class="btn btn-default pull-left">Submit</button>
		</form>

      </div>
      
<?php
include("footer.php");
?>
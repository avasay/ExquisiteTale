var isLastImg = new Boolean(false);
var isLastTxt = new Boolean(false);
var lastImg;
var lastTxt;

function setValuelastImg(x)
{
    lastImg = x;
}

function isEmpty(str) {
	return (!str || 0 === str.length);
}

function setup_titles() {
var geo = 'titles.json';
				//var geo = "backside.php?func=storyList";
				
				$.getJSON(geo, function(jd) {
				
					var json_text = JSON.stringify(jd, undefined, 4);
					console.log("JSON Text:" + json_text);
					var jsonReviews = JSON.parse(json_text);
					
					
					for(var i=0; i < jsonReviews.storyList.length; i++) {
						var someDiv = $('<div>');
						someDiv.addClass("et-title");
						someDiv.addClass("pull-left");
						
						$('<a>', {
							'href': "slideshow.php?storyID=" + jsonReviews.storyList[i].storyID,
							text: jsonReviews.storyList[i].title
						})
						.appendTo(someDiv);
						
						var someDiv2 = $('<div>');
						someDiv2.addClass("span6");
						someDiv2.append(someDiv);
						$('#et-title-row').append(someDiv2);
				    }
				
				});
          		
}

function setup_slideshow_indicator(filename) {
var geo = filename;
console.log(filename);
		          		$.getJSON(geo, function(jd) {
		          	
			      	 		var json_text = JSON.stringify(jd, undefined, 4);
							console.log("JSON Text:" + json_text);
							var jsonReviews = JSON.parse(json_text);
							
							// FIRST FRAME IS ACTIVE
							var someDiv = $('<li>').attr("data-target", "#myCarousel" ).attr("data-slide-to",0);
							someDiv.addClass("active");
							$('#et-indicator').append(someDiv);
								
							// REST OF THE FRAMES ARE NOT ACTIVE UNTIL ARROW CLICKED
							for(var i=1; i < jsonReviews.story.contribList.length; i++) {
								var someDiv = $('<li>').attr("data-target", "#myCarousel" ).attr("data-slide-to",i);
								someDiv.addClass("");
								$('#et-indicator').append(someDiv);
				            }
			        
		          		});
		          		

}

function setup_slideshow_main(filename) {
var geo = filename;
	          		$.getJSON(geo, function(jd) {
	          	
		      	 		var json_text = JSON.stringify(jd, undefined, 4);
						console.log("JSON Text:" + json_text);
						var jsonReviews = JSON.parse(json_text);
						
						$("#et-slide-title").text(jsonReviews.story.title);
						// FIRST FRAME IS ACTIVE
						var someDiv = $('<div>');
						someDiv.addClass("item active"); 
						someDiv.addClass("et-slide-frame");
						if(!isEmpty(jsonReviews.story.contribList[0].image)) {
							someDiv.append($('<img>').attr('src', jsonReviews.story.contribList[0].image));
						}
						if(!isEmpty(jsonReviews.story.contribList[0].text)) {	
							someDiv.append(jsonReviews.story.contribList[0].text);
						}
						$('#et-slide-inner').append(someDiv);
							
						// REST OF THE FRAMES ARE NOT ACTIVE UNTIL ARROWS CLICKED
						var i;
						for(i=1; i < jsonReviews.story.contribList.length; i++) {
							var someDiv = $('<div>');
							someDiv.addClass("item");
							someDiv.addClass("et-slide-frame");
							if(!isEmpty(jsonReviews.story.contribList[i].image)) {
								someDiv.append($('<img>').attr('src', jsonReviews.story.contribList[i].image));
							}
							if (!isEmpty(jsonReviews.story.contribList[i].text)) {
    							someDiv.append(jsonReviews.story.contribList[i].text);
							}
							$('#et-slide-inner').append(someDiv);
			            }
			            
			            // LAST CONTRIBUTIONS
			            if(!isEmpty(jsonReviews.story.contribList[i-1].image)) {
    	
							isLastImg = true;
							isLastTxt = false;
							//setValuelastImg(jsonReviews.story.contribList[i-1].image);
							//lastImg = jsonReviews.story.contribList[i-1].image;
							//console.log(lastImg);
							document.getElementById("contribute-btn").href="contributetext.php?filename=" + filename; 
							document.getElementById("et-contribute-last-text").src=jsonReviews.story.contribList[i-1].image;
							console.log("Last Contribution was Image");
							
						}
						if (!isEmpty(jsonReviews.story.contribList[i-1].text)) {
							isLastImg = false;
							isLastTxt = true;
							lastTxt = jsonReviews.story.contribList[i-1].text;
							$("div#et-text-previous").text(jsonReviews.story.contribList[i-1].text);
							
							document.getElementById("contribute-btn").href="contributeimage.php?filename=" + filename; 
							console.log("Last Contribution was Text");
						}
						
						
		        		
	          		});
	          		
}

function getLastImg(filename) {
	var geo = filename;
	          		$.getJSON(geo, function(jd) {
	          	
		      	 		var json_text = JSON.stringify(jd, undefined, 4);
						console.log("JSON Text:" + json_text);
						var jsonReviews = JSON.parse(json_text);
						
						var i = jsonReviews.story.contribList.length;
						document.getElementById("et-contribute-last-text").src=jsonReviews.story.contribList[i-1].image;
						$('#hidden_filename').val(geo);
						
	          		});
	          		
}


function getLastTxt(filename) {
	var geo = filename;
	          		$.getJSON(geo, function(jd) {
	          	
		      	 		var json_text = JSON.stringify(jd, undefined, 4);
						console.log("JSON Text:" + json_text);
						var jsonReviews = JSON.parse(json_text);
						
						var i = jsonReviews.story.contribList.length;
						//document.getElementById("et-contribute-last-text").src=jsonReviews.story.contribList[i-1].image;
						
						$("div#et-text-previous").text(jsonReviews.story.contribList[i-1].text);
						$("#hidden_filename").val(geo);
						
	          		});
	          		
}

$(document).ready(function(){
	
	 /*
    var video = document.querySelector("#video");

    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    if (navigator.getUserMedia) {
        navigator.getUserMedia({video: true}, handleVideo, videoError);
    }

    function handleVideo(stream) {
        video.src = window.URL.createObjectURL(stream);
    }

    function videoError(e) {
        // do something
    }
    */

	// Grab elements, create settings, etc.
	var video = document.getElementById('videoElement');
	
	// Get access to the camera!
	if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	    // Not adding `{ audio: true }` since we only want video now
	    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
	        video.src = window.URL.createObjectURL(stream);
	        video.play();
	    });
	}
	//Call Geolocation 
	getGeoLocation();
	
	// Trigger photo take
	/*
	document.getElementById("snap").addEventListener("click", function() {
	  context.drawImage(video, 0, 0, 640, 480);
	  var img= convertCanvasToImage();
	  console.log(img);
	});
	*/
	// Converts canvas to an image
	function convertCanvasToImage() {
		var image = new Image();
		image.src = canvas.toDataURL("image/png",1.0);
		return image;
	}

	function getGeoLocation() 
	{
	    var cord= '';
	    if (navigator.geolocation) 
	    {
	        navigator.geolocation.getCurrentPosition(function(position) {
		        var lat = position.coords.latitude;
		        var lng = position.coords.longitude;
		        document.getElementById('geolocation').value  = lat+','+lng;
					
		    }, function(error) {
		        //document.getElementById('geolocation').value  = '';
		        ipInfoApi();
		    });
	    } 
	    else 
	    {
	    	ipInfoApi();
	    }
	}
	
	function ipInfoApi()
	{
		$.get("https://ipinfo.io", function (response) {
			    var resLoc = response.loc;
			    if(resLoc)
			    {
			      document.getElementById('geolocation').value  = resLoc;
			    }
			    else 
			    {
			    	document.getElementById('geolocation').value  = '';
			    }
			}, "jsonp");
	}
	
	$(document).on('click','#take_selfie_subt',function (e) {
		e.preventDefault();
		var staff_id		= $(this).data('staff_id');
		var geolocation 	= document.getElementById('geolocation').value;
		if(geolocation!='')
		{
			//$('#take_selfie_subt').attr('id','');
			// Elements for taking the snapshot
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');
			var video = document.getElementById('videoElement');
			context.drawImage(video, 0, 0, 640, 480);
	  		var img= convertCanvasToImage();
			
	  		//console.log(img);
	  		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) 
	  		{
			 take_snapshot(staff_id,img);
			}
			else
			{
				alert('Unable to access camera');
			}
		}
		else
		{
			alert('Location Needed To Be Shared in order to mark Attendance');
			window.location.reload();
		}
   });
   
  function take_snapshot(staff_id,img) 
  {
		//http://stackoverflow.com/a/28309845/4119740
      var data_uri = img;
      var staffid  = staff_id;
      var image_fmt = 'png';
      var ctype = document.getElementById('vclocktype').value;
      var geolocation = document.getElementById('geolocation').value;
      var furl = base_url+'selfieattendance/attendance/whosaroundtoday';
      
	    if(data_uri!=true&&geolocation!=''&&geolocation!=0)
	    {
			var url = base_url+'selfiemarking/selfie/save_selfie';
			//document.getElementById('selfie-loader').style.display = 'block';
			var file =  data_uri.src;
			//console.log(file);
			
	    	var formdata = new FormData();
	    	formdata.append("base64image", file);
	    	formdata.append('csrf_test_name',csrf_token);
	    	formdata.append('staffid',staffid);
	    	formdata.append('geolocation',geolocation);
	    	formdata.append('image_fmt',image_fmt);
	    	formdata.append('clktype',ctype);
	    	var ajax = new XMLHttpRequest();
	    	ajax.addEventListener("load", function(event) { uploadcomplete(event,furl);}, false);
	    	ajax.open("POST", url);
	    	ajax.send(formdata);
	    }
	    else
	    {
	    	 if(geolocation==''&&geolocation!=0){
	    	 	alert('Snap Shot Failed. Please Share Your Location');
	    	 }
	    }
  }
  
  function uploadcomplete(event,furl){
    var response	=	event.target.responseText.trim();
    if(response=='Failed')
    {
    	alert('Snap Shot Failed. Please Contact your Administrator.');
    }
    else
    {
    	alert('Clock-in Alert!!');
    	window.location.replace(furl);
    }
  }

	
});   

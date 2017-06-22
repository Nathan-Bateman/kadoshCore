jQuery(document).ready(function() {
   
	(function($) {
	
		var videoPresent = document.querySelector('#wp-custom-header-video');
		var customHeader = document.getElementById('wp-custom-header');

			if(videoPresent !== null){
				customHeader.classList.add("video-header-wrapper");
				// $( ".video-header-wrapper" ).append( "<p>Testing again</p>" );
			}
	    console.log('main.js works');
		


	    //Array of event object for FullCalendar
	    var eventsFullCalendar = [];
	    //Get the WP JSON containing each event's data
	    function loadEventData () {

	    	var makeEvent = function (start, end, title, dow, until) {
	    						this.dow,
							    dow !== 'undefined' ? this.dow = [dow] : console.log('noen');
							    this.start = start;
							    this.end = end;
							    this.title = title;
							    this.until = until;
							    
							}
	    	var URL = 'http://localhost:8888/wp-json/wp/v2/events/?per_page=100';
	    	

	    	$.ajax({
	          url: URL,
	          // dataType: 'jsonp',
	          success: function(response){
	          	//console.log(response);
	          	for(event in response) {
	          		
	          		var eventObjectRaw = response[event];
	          		var start = moment.unix(eventObjectRaw.start).format("MM/DD/YYYY, h:mm a");
	          		var dow;
	          		
	          		var end = moment.unix(eventObjectRaw.end).format("MM/DD/YYYY, h:mm a");
	          		var title = eventObjectRaw.title.rendered;
	          		var recurring = eventObjectRaw.recurring;
	          		recurring == "0" ? recurring = false : recurring = true;
	          		recurring === true ? dow = moment(start).day() : dow = null;
	          		console.log(dow);
	          		var until = eventObjectRaw.until;
	          		if (dow === null) {
	          			var thisOne = new makeEvent(start, end, title);
	          		} else {
	          			var thisOne = new makeEvent(start, end, title, dow);
	          		}
	          		
	          		 console.log(thisOne);
	          		 eventsFullCalendar.push(thisOne);

	          	}
			        //for fullCalendar
			       $('#calendar').fullCalendar({
		        		// put your options and callbacks here
		        		// events: eventsFullCalendar
		        		events: [{
							    title:"My repeating event",
							    start: '10:00', // a start time (10am in this example)
							    end: '14:00', // an end time (2pm in this example)
							    dow: [ 2 ] // Repeat monday and thursday
							}] 
		        	
		    		})
	          }, error: function (){
	            //$myModal.modal('show');
	            console.log('not working');
	          }
           });
	    }
	    loadEventData();

	    
	})( jQuery );
}); 
//Below is for the Google Calendar - 
// googleCalendarApiKey: 'AIzaSyDRUp_pzNUDt3vD0D9OHYh-N2dzkDAUSm4',
//         	events: {
//             	googleCalendarId: 'pa5lcdh57smd12b6avdmgc3l7s@group.calendar.google.com'
//         	}	







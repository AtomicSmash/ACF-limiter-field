(function($){

	/*
	*  acf/setup_fields
	*
	*  This event is triggered when ACF adds any new elements to the DOM. 
	*
	*  @type	function
	*  @since	1.0.0
	*  @date	01/01/12
	*
	*  @param	event		e: an event object. This can be ignored
	*  @param	Element		postbox: An element which contains the new HTML
	*
	*  @return	N/A
	*/
	
	
	function characterLimit(currentField){
	
		progressBar = $(currentField).next(".progressBar");
		
	    chars = $(currentField)[0].value.length;
	    
	    limit = $(currentField).data('characterlimit');
	    
	    //console.log(chars);
	    if (chars > limit) {
	        currentField.value = currentField.value.substr(0, limit);
	        chars = limit;
	    }
	
	    charactersRemaining = limit - chars;
	    
	    $(currentField).next().next(".counterWrapper").children(".limiterCount").html(chars);
	    
	    percentage = Math.floor((chars / limit)*100);
	    
	
	    $( progressBar ).progressbar({
	      value: percentage
	    });
	
	}

	$(document).live('acf/setup_fields', function(e, postbox){
		
		
		//Setup progress bars of all limiter fields
		$(postbox).find('.limiterField').each(function(){
			characterLimit(this);
		});
		
		//Run characterLimit() when the field is being used
		$(postbox).find('.limiterField').live("keyup focus", function() {
			characterLimit(this);
		});
		
	
	});

})(jQuery);

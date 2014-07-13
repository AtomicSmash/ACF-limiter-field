(function($){
	function characterLimit(currentField){
	
		progressBar = $(currentField).next(".progressBar");
				
	    chars = $(currentField)[0].value.length;
	    
	    limit = $(currentField).data('characterlimit');
	    
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
	
	
	function initialize_field( $el ) {
		
		//$el.doStuff();
		
		//Setup progress bars of all limiter fields

		$($el).find('.limiterField').each(function(){
			characterLimit(this);
		});

		
		//Run characterLimit() when the field is being used
		$($el).find('.limiterField').live("keyup focus", function() {
			characterLimit(this);
		});
		
	

		
		
		
		
	}
	
	
	if( typeof acf.add_action !== 'undefined' ) {
	
		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'limiter'
			acf.get_fields({ type : 'limiter'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});
			
		});
		
		
	} else {
		
		
		/*
		*  acf/setup_fields (ACF4)
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
		*  @return	n/a
		*/
		
		$(document).live('acf/setup_fields', function(e, postbox){
			
			$(postbox).find('.field[data-field_type="limiter"]').each(function(){
				
				initialize_field( $(this) );
				
			});
		
		});
	
	
	}


})(jQuery);

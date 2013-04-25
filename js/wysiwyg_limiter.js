var loadrepeater = function ( ed ) {
		//console.log(ed.startContent);
		
    if(ed.editorId != "content"){


		ed.editorDomLocation = "#wp-"+ed.editorId+"-wrap";
		ed.characterLimit = jQuery(ed.editorDomLocation).next(".progressBar").data('characterlimit');
	    
	    if(ed.characterLimit != ""){
			cnt_cur = ed.startContent.replace(/<\/?[^>]+(>|$)/g,"").replace(/&nbsp;/gi,"");
		    
		    //alert(jQuery(ed.editorDomLocation).next(".progressBar").data('characterlimit'));
		    
		    percentage = Math.floor((cnt_cur.length / ed.characterLimit)*100);
		    //alert(percentage);
			progressBar = jQuery(ed.editorDomLocation).next(".progressBar");
	
		    jQuery( progressBar ).progressbar({
		      value: percentage
		    });
		    
		    
		    jQuery(ed.editorDomLocation).next().next(".progressText").html( cnt_cur.length + " out of " + ed.characterLimit);
		    
	    }
		
		
	}

}

var repeater = function ( e,ed ) {
	if(ed.characterLimit != ""){

		//console.log(e);
		console.log(ed);
		
	    var targetId = e.target.id;
	    var text = '';
	
		switch ( targetId ) {
		
			case 'content':
				text = jQuery('#content').val(); 
				break;
		     
			case 'tinymce':
				if ( tinymce.activeEditor )
					text = tinymce.activeEditor.getContent();
				break;
		}
	    
	    
	    
		//console.log(text.length);
		
		cnt_cur = text.replace(/<\/?[^>]+(>|$)/g,"").replace(/&nbsp;/gi,"");
		
		//console.log(cnt_cur.length);
		//alert(targetId);
	    if(ed.editorId != "content"){
	    
	    	if(e.type == 'keydown'){
			//}
			//alert(browserIsIE);
	
			//alert(text);
				if(cnt_cur.length <= ed.characterLimit){
					ed.TESTval = text;
				}
			}else{
				
				if(text != ed.TESTval){
					if(cnt_cur.length > ed.characterLimit){
						var bookmark = ed.selection.getBookmark(2, true);
						ed.setContent(ed.TESTval);
						ed.selection.moveToBookmark(bookmark);
									
					
					
					}
				}				
			}
		}
	    
	    
	    
	    percentage = Math.floor((cnt_cur.length / ed.characterLimit)*100);
		    //alert(percentage);
			progressBar = jQuery(ed.editorDomLocation).next(".progressBar");
	
		    jQuery( progressBar ).progressbar({
		      value: percentage
		    });    
	    
	    jQuery(ed.editorDomLocation).next().next(".progressText").html( cnt_cur.length + " out of " + ed.characterLimit);
	    
	    
		    
		
	    
    
    }
}

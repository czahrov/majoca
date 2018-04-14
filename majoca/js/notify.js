$(function(){
	
	(function( notify ){
		if( notify.length ){
			window.setTimeout( function(){
				window.location.href = window.location.href;
				
			}, 3000 );
			
		}
		
	})
	(
		$( '#notify' )
	);
	
});
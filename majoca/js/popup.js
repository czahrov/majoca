$(function(){
	
	(function( popup, box, close, description, kolor, trigger ){
		
		var TL = new TimelineLite({
			paused: true,
			onStart: function(){
				popup.addClass( 'open' );
				
			},
			onReverseComplete: function(){
				popup.removeClass( 'open' );
				
			},
			
		})
		.add( 'start', 0 )
		.add(
			TweenLite.fromTo(
				popup,
				.5,
				{
					opacity: 0,
				},
				{
					opacity: 1,
					ease: Power4.easeInOut,
				}
			),
			'start'
		)
		.add(
			TweenLite.fromTo(
				box,
				.5,
				{
					opacity: 0,
					yPercent: 25,
				},
				{
					yPercent: 0,
					opacity: 1,
					ease: Power4.easeOut,
				}
			),
			'start+=.3'
		);
		
		popup
		.on({
			open: function( e ){
				TL.play();
				
			},
			close: function( e ){
				TL.reverse();
				
			},
			
		})
		.add( close )
		.click( function( e ){
			popup.triggerHandler( 'close' );
			
		} );
		
		box.click( function( e ){
			e.stopPropagation();
			
		} );
		
		trigger.click( function( e ){
			e.preventDefault();
			popup.triggerHandler( 'open' );
			
		} );
		
		kolor
		.on({
			change: function( e ){
				description.text( kolor.children( 'option:selected' ).attr( 'description' ) );
				
			}
			
		});
		
		
	})
	(
		$( '#popup' ),
		$( '#popup > .box' ),
		$( '#popup > .box > .close' ),
		$( '#popup > .box form > .description' ),
		$( '#popup > .box form > select' ),
		$( 'a[href*="#order"]' )
	);
	
});
$(function(){
	
	(function( slider, view, items, navs ){
		var current = -1;
		var lock = false;
		var itrv = null;
		var duration = 1000;
		var interval = 3000;
		
		slider.on({
			init: function( e ){
				slider.triggerHandler( 'set', 'next' );
				slider.triggerHandler( 'start' );
				
			},
			next: function( e ){
				if( !lock ){
					lock = true;
					// current++;
					slider.triggerHandler( 'set', 'next' );
					
				}
				
			},
			prev: function( e ){
				if( !lock ){
					lock = true;
					// current--;
					slider.triggerHandler( 'set', 'prev' );
					
				}
				
			},
			set: function( e, direction ){
				current += direction ===  'next'?( 1 ):( -1 );
				if( current < 0 ) current = items.length - 1;
				current %= items.length;
				
				new TimelineLite()
				.staggerFromTo(
					items,
					duration / 1000,
					{
						x: 0,
						cycle:{
							yPercent: function( index, item ){
								if( direction === 'next' ){
									return ( ( index + current ) % items.length - 2 ) * 100;
									
								}
								else{
									return ( ( index + current ) % items.length ) * 100;
									
								}
								
							},
							
						},
						
					},
					{
						cycle:{
							yPercent: function( index, item ){
								if( direction === 'next' ){
									return ( ( index + current ) % items.length - 1 ) * 100;
									
								}
								else{
									return ( ( index + current ) % items.length - 1 ) * 100;
									
								}
								
							},
							
						},
						onComplete: function(){
							lock = false;
							
						},
						
					}
					
				);
				
			},
			stop: function( e ){
				window.clearInterval( itrv );
				
			},
			start: function( e ){
				slider.triggerHandler( 'stop' );
				itrv = window.setInterval( function(){
					slider.triggerHandler( 'next' );
					
				}, interval );
				
			},
			mouseenter: function( e ){
				slider.triggerHandler( 'stop' );
				
			},
			mouseleave: function( e ){
				slider.triggerHandler( 'start' );
				
			},
			
		});
		
		view
		.swipe({
			swipeLeft: function( e ){
				slider.triggerHandler( 'prev' );
				
			},
			swipeUp: function( e ){
				slider.triggerHandler( 'prev' );
				
			},
			swipeRight: function( e ){
				slider.triggerHandler( 'next' );
				
			},
			swipeDown: function( e ){
				slider.triggerHandler( 'next' );
				
			},
			
		});
		
		navs
		.click( function( e ){
			if( $(this).hasClass( 'down' ) ){
				slider.triggerHandler( 'next' );
				
			}
			else{
				slider.triggerHandler( 'prev' );
				
			}
			
		} );
		
		slider.triggerHandler( 'init' );
		
	})
	(
		$( '#slider' ),
		$( '#slider > .view' ),
		$( '#slider > .view > .item' ),
		$( '#slider > .nav > .icon' )
	);
	
});
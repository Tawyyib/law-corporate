<?php   

if(!function_exists('lc_data_refresh')){

	function lc_data_refresh(){

		?>
		
			<!-- Refreshes Web Forms History -->
			<script> 

				if(window.history.replaceState){
					
					window.history.replaceState( null, null, window.location.href );
					
				}
				
			</script>
						
		<?php 

	}
	add_action('', 'lc_data_refresh');

}
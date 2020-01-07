$(document).ready(function(){

	$('.delete').on('click',function(){
		if(!confirm('Do you really want to delete "'+$(this).attr('data-name')+'"?')){
			return false;
		}
	})




})
$(document ).ready(function() {
    $('.set_role').change(function(){
    	let option_pre = $(this).children("option:selected").val();
    	$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
    	$.ajax({
		  method: "PUT",
		  url: "/user/update_role/" + $(this).attr( "data" ),
		  data: {"role": $(this).children("option:selected").val()}
		})
		  .done(function( data ) {
		  	if(data.type == "failed"){
		  	}
		    alert( "Data Saved: " + data.msg );
		  });
    });
});
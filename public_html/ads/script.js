$( document ).ready(function() {
	function price(){
			var min = $("#minVal").val();
			var max = $("#maxVal").val();
			if(($.isNumeric(min)) && ($.isNumeric(max))){
				
				$.get( "/ajax/gAds.php?min="+min+"&max="+max, function( data ) {
					if(data != ""){
						$("#adView").html(data);
					};
				});
			};
		}

	$("#filPrice").click(function(e){
		e.preventDefault();
		price();
	});

		$("#filDate").click(function(e){
			e.preventDefault();
			var start = $("#startDate").val();
			var end = $("#endDate").val();
			var min = $("#minVal").val();
			var max = $("#maxVal").val();
			if(($.isNumeric(min) && $.isNumeric(max)) && (start != "" || end != "")){
				
				$.get( "/ajax/gAds.php?min="+min+"&max="+max+"&start="+start+"&end=", function( data ) {
					if(data != ""){
						$("#adView").html(data);
					};
				});
			};
		});
	});
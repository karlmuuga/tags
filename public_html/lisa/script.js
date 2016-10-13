$( document ).ready(function() {
	/*$(".nupp").click (function(){
			setTimeout(function(){
				$("#had1").html("€"+$("#ad1").val());
				$("#had2").html("€"+$("#ad2").val());
				var hind = parseFloat($("#ad1").val())+parseFloat($("#ad2").val());
				$("#had").html("Hind kokku: €"+hind);
			},100);	
	});	*/
	$("#sel").click (function(e){
		e.preventDefault();
		$("#modal").modal();
	});

	$("#adadd").click (function(e){
		e.preventDefault();
		var cat = $("#kategooria").val();
		var date = $("#kuup2ev").val();
		var time = $("#time").val();
		var title = $("#pealkiri").val();
		var descri= $("#kirjeldus").val();
		var state = $("#asukoht option:selected" ).text();
		var addr = $("#aadress").val();
		var price = $("#hind").val();
		var qty = $("#kogus").val();
		var ad1 = $("#ad1").val();
		var ad2 = $("#ad2").val();
		var pic = $("#pic").val();
		var type = $("#type option:selected" ).text();
		
		$.post("ajax.php",{
			kategooria: cat,
			kuup2ev: date,
			time: time,
			pealkiri: title,
			kirjeldus: descri,
			asukoht: state,
			aadress: addr,
			hind: price,
			kogus: qty,
			pic: pic,
			type: type
		},
		function(data, status){
			if(status == "success"){
				$("#back").html(data);
				if (data.indexOf("<span style='color:green'") != -1){
					var id = $("#aide").html();
					setTimeout(function(){window.location.href = "http://tags.ee/?id="+id;},1500);
				};
			}else{
				$("#back").html("Päring nurjus, võtke administraatoriga ühendust");$("#back").css("color","red");
			}
		});
	});
});

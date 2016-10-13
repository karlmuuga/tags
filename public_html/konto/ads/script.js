$( document ).ready(function() {
	/*$("#time").keyup (function(){
		if($("#time").val().length == 2){
			$("#time").val($("#time").val()+".");
		}
	});*/
	
	$("#kuup2ev").keyup (function(){
		if($("#kuup2ev").val().length == 2 || $("#kuup2ev").val().length == 5){
			$("#kuup2ev").val($("#kuup2ev").val()+"/");
		}
	});
	
	$(".nupp").click (function(){
			setTimeout(function(){
				$("#had1").html(""+$("#ad1").val());
				$("#had2").html(""+$("#ad2").val());
				var hind = parseFloat($("#ad1").val())+parseFloat($("#ad2").val());
				$("#had").html("Hind kokku: "+hind);
			},100);	
	});
	
	$("#close").click (function(){
		$('#picmodal').modal('hide');
	});
	
	
});
function muuda(id){
	if($.isNumeric(id)){
		$.get( "gAd.php?id="+id, function( data ) {
		$("#adModal").html(data);
			if(data === ""){
				alert("Vabandame, kuid teie päring ebaõnnestus.");
			}else{
				$("#adModal").modal();
			}
		});
	};	
};

function del(id,title){

var bool = confirm('Kas soovid tõesti oma kuulutuse '+title+' kustutada?');
if(bool == true){

$.get('/ajax/delAd.php?id='+id, 

function(data, status){

	if(data == 'kustutatud'){
	
		$("#"+id).remove();
		var arv = $("#arv").html();
		$("#arv").html(parseInt(arv)-1);
		alert('Teie kuulutus ´'+title+'´ on kustutatud! :(');

	}else{
		alert(data);
	}
})}

};

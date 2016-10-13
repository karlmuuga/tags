$(document).ready(function (e) {
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();

$.ajax({
url: "upload.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
if (data.indexOf("tags.ee") >= 0){
	$("#pic").val(data);
	$("#message").html("Teie pilt on edukalt üles laetud!")
	
	;
	$("#message").css("color","green");
	setTimeout(function(){$('#modal').modal('hide');},1500);
}
}
});
}));

// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p style='color:green'>Palun vali korrektne pilt!</p>"+"<h4>Pane tähele, et</h4>"+"<span style='color:green'>Ainult jpg, jpeg, ja png on lubatud.</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '300px');
};
});
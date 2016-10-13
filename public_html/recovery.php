<?php session_start();if(isset($_SESSION['token'])){header("Location: http://tags.ee");die();}include 'includes/h.php';head("Unustasid parooli");?>
<style>
#email{
    color: #000;
    border: 1px solid #292C2E;
    padding-right: 50px;
    display: block;
    width: 30%;
    height: 46px;
    padding: 6px 12px;
    font-size: 1em;
    font-weight: 300;
    line-height: 1.42857}
</style>
<div class="page-content">
    
      <!--Breadcrumbs-->
      <ol class="breadcrumb">
        <li><a href="/">Avaleht</a></li>
        <li>Unustasid parooli</li>
      </ol><!--Breadcrumbs Close--><div  style="padding:50px"><h1>Sisesta allolevasse välja enda e-maili aadress, et me saaksime sellele sinu uue parooli saata!</h1>
		<hr><form action="javascript:void(0);">
			<input name="email" id="email" placeholder="Sisestage oma e-mail" required="" type="email"><br>
			<button class="btn btn-black" id="go">Saada!</button>
		</form>
		<h1 id="ret"></h1>
		</div>
	  </div>
	  
	  <script>
	  $( document ).ready(function() {
		$("#go").click (function(){
			var email = encodeURI($("#email").val());
			console.log("Go!");
		  	$.get( "ajax/recPwd.php?email="+email, function( data ) {
				if(data != ""){
					$("#ret").html(data);
				}else{
					$("#ret").html("Vabandust, kuid midagi läks valesti..");$("#ret").css("color","red");
				}
			});
	    });		
	  });
	  </script>
<?php foot();?>
<?php session_start();if (isset($_SESSION['token'])) {header("Location: /");}include "../includes/h.php";head("Liitu TAGsiga");?>
<!--Page Content-->
<div class="page-content">

	<!--Breadcrumbs-->
	<ol class="breadcrumb">
		<li><a href="/">Avaleht</a></li>
		<li>Liitu TAGsiga</li>
	</ol>
	<!--Breadcrumbs Close-->

	<!--Login / Register-->
	<section class="log-reg container">
		<h2><?php if(isset($_GET['r'])){echo "Enne kuulutuse lisamist l";}elseif(isset($_GET['b'])){echo "Enne oma konto nägemist l";}else{echo "L";} ?>ogi sisse või registreeri end</h2>
		<!--h>Use social accounts</h4>
       <div class="social-login">
        <a class="facebook" href="/#"><i class="fa fa-facebook-square"></i></a>
        <a class="google" href="/#"><i class="fa fa-google-plus-square"></i></a>
        <a class="twitter" href="/#"><i class="fa fa-twitter-square"></i></a>
        </div-->

		<div class="row">
			<!--Login-->
			<div class="col-lg-5 col-md-5 col-sm-5">
				<form class="login-form">
					<span id="logmess2"></span>
					<div class="form-group group">
						<label for="log-email2">E-mail</label> <input type="email"
							class="form-control" name="logemail" id="logemail2"
							placeholder="Sisestage oma e-mail" required>
						<!--a class="help-link" href="/#">Forgot email?</a-->
					</div>
					<div class="form-group group">
						<label for="log-password2">Parool</label> <input type="password"
							class="form-control" name="logpassword" id="logpassword2"
							placeholder="Sisestage oma parool" required> <a class="help-link"
							href="http://tags.ee/recovery.php">Unustasite enda parooli?</a>
					</div>
					<div class="checkbox" id="cBoxl">
						<label><input type="checkbox" name="remember" id="cboxl"> Hoia
							mind sisse logituna</label>
					</div>
					<button class="btn btn-black" id="logi">Logi sisse</button>

				</form>
			</div>

			<script>
		  $(document).ready(function() {
		  <?php
				if (isset ( $_GET ['a'] )) {
					echo 'alert("Teie konto on edukalt aktiveeritud!");';
				}
				?>
		  $("#logi").click(function(e){
			e.preventDefault();
	  var logemail = $("#logemail2").val();
	  var logpassword = $("#logpassword2").val();
	  $("#logmess2").css("color","red");
	  if(logemail == "" || logpassword == ""){
		$("#logmess2").html("Palun sisestage kõik andmed korrektselt!");
	  }else{
	  
	  $.post("/ajax/chckAcc.php",
				{
					logemail: logemail,
					logpassword: logpassword
				},
				function(data, status){
					 if(data == "1"){
			  $("#logmess2").html("Olete edukalt sisse logitud!");
	  		  $("#logmess2").css("color","green");
  		      var page = $(location).attr("href");
		  	  setTimeout(function(){$(location).attr("href", page);},1500);
						
		    }else{
			  $("#logmess2").html("Vabandame, kuid meie andmed ei ühti!");
		      $("#logpassword2").val("");
		    };
				});
	  
	  };
			});
		});
		
		
		  </script>
			<!--Registration-->

			<div class="col-lg-7 col-md-7 col-sm-7">
				<form class="registr-form" action="javascript:void(0);">
					<span id="regMess"></span>
					<div class="form-group group">
						<label for="rf-email">E-mail</label> <input type="email"
							class="form-control" name="rf-email" id="rfemail"
							placeholder="Sisestage oma e-mail" required>
					</div>
					<div class="form-group group">
						<label for="rf-password">Parool</label> <input type="password"
							class="form-control" name="rf-password" id="rfpassword"
							placeholder="Sisestage oma parool" required>
					</div>
					<div class="form-group group">
						<label for="rf-password-repeat">Sisestage oma parool uuesti</label>
						<input type="password" class="form-control"
							name="rf-password-repeat" id="rfpasswordrepeat"
							placeholder="Sisestage oma parool uuesti" required>
					</div>
					<div class="form-group group">
						<label for="fullname">Täisnimi</label> <input type="text"
							class="form-control" name="fullname" id="fullname"
							placeholder="Sisestage oma täisnimi" required>
					</div>
					<div class="form-group group">
						<label for="fullname">Mobiiltelefon</label> <input type="text"
							class="form-control" name="phone" id="phone"
							placeholder="XXXXXXXX" required>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" name="remember" id="cBox" required>Ma
							olen lugenud <a href="../terms.php">kasutajatingimusi</a> ja
							nõustun nendega.</label>
					</div>
					<button class="btn btn-black" id="rega">Registreeri</button>
				</form>
			</div>
		</div>
	</section>
	<!--Login / Register Close-->
</div>
<!--Page Content Close-->
<script>
	$(document).ready(function() {
		
		$("#rega").click(function(){
			
			var rfemail = $("#rfemail").val();
			var rfpassword = $("#rfpassword").val();
			var rfpasswordrepeat = $("#rfpasswordrepeat").val();
			var fullname = $("#fullname").val();
			var phone = $("#phone").val();
			var state = $("#state").val();
				
			

		if ($('#cBox').is(':checked')) {
			
			$.post("http://tags.ee/ajax/regAcc.php",
				{
					rfemail: rfemail,
					rfpassword: rfpassword,
					rfpasswordrepeat: rfpasswordrepeat,
					fullname: fullname,
					phone: phone,
					state: state
				},
				function(data, status){
					if(data == "success"){
						$("#regMess").html("<span style='color:green'>Kasutaja aadressiga <span style='fontweight:bold'>"+rfemail+"</span> on edukalt registreeritud!\nSamuti on saadetud aadressile aktivatsioonilink.</span>");
						
						$("#rfemail").val("");
						$("#rfpassword").val("");
						$("#rfpasswordrepeat").val("");
						$("#fullname").val("");
						$("#phone").val("");
						$("#state").val("");
					}else{
						$("#regMess").html(data);
					}window.scrollTo(0,0);
				});
				
		}else{
			
			$("#regMess").html("<span style='color:red'>Registreerimiseks pead nõustuma tingimustega!</span>");
			
		}
		
		});
		
				
		
	});

	</script>
<?php foot();?>













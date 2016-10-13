<?php session_start();include '../includes/h.php';if(!isset($_SESSION['token'])){header("Location: /sisene");}head("Minu konto");?>
<script type="text/javascript" src="script.js"></script>
<div class="modal fade" id="pwdModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Muuda parooli</h2>
			</div>
			<div class="modal-body">
				<form class="login-form">
					<span id="retMessPwd"></span>
					<div class="form-group group">
						<label for="oldPwd">Vana parool</label> <input type="password"
							class="form-control" name="oldPwd" id="oldPwd"
							placeholder="Sisestage oma vana parool" required>
					</div>
					<div class="form-group group">
						<label for="newPwd">Uus parool</label> <input type="password"
							class="form-control" name="newPwd" id="newPwd"
							placeholder="Sisestage oma uus parool" required> <label
							for="newPwdrep">Uus parool uuesti</label> <input type="password"
							class="form-control" name="newPwdrep" id="newPwdrep"
							placeholder="Korrake oma uut parooli" required>
					</div>
					<button class="btn btn-black" id="changePwd">Vaheta parooli</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Muuda e-maili aadressi</h2>
			</div>
			<div class="modal-body">
				<form class="login-form">
					<span id="retMessEmail"></span>
					<div class="form-group group">
						<label>Uus e-maili aadress</label> <input type="email"
							class="form-control" name="email" id="email"
							placeholder="Sisestage oma uus meiliaadress" required>
						<h4>Aadressi kinnitamisel saadetakse sellele kinnitusmeil, milles
							on vaja avada vastav link. Meili võite leida ka rämpsposti
							kaustast.</h4>
					</div>
					<button class="btn btn-black" id="changeeMail">Vaheta aadressi</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="phoneModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Muuda mobiiltelefoninumbrit</h2>
			</div>
			<div class="modal-body">
				<form class="login-form">
					<span id="retMessPhone"></span>
					<div class="form-group group">
						<label>Uus mobiiltelefoninumber</label> <input type="text"
							class="form-control" name="phone" id="phone"
							placeholder="Sisestage oma uus number" required>
					</div>
					<button class="btn btn-black" id="changePhone">Vaheta
						telefoninumbrit</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="nameModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Muuda nime</h2>
			</div>
			<div class="modal-body">
				<form class="login-form">
					<span id="retMessName"></span>
					<div class="form-group group">
						<label>Uus nimi</label> <input type="text" class="form-control"
							name="name" id="name" placeholder="Sisestage oma täisnimi"
							required>
					</div>
					<button class="btn btn-black" id="changeName">Vaheta nime</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="stateModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Muuda elukohta</h2>
			</div>
			<div class="modal-body">
				<form class="login-form">
					<span id="retMessState"></span>
					<div class="form-group group">
						<label>Uus elukoht</label> <input type="text" class="form-control"
							name="state" id="state" placeholder="Sisestage oma uus elukoht"
							required>
					</div>
					<button class="btn btn-black" id="changeState">Vaheta elukohta</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="page-content">

	<!--Breadcrumbs-->
	<ol class="breadcrumb">
		<li><a href="/">Avaleht</a></li>
		<li>Minu konto</li>
	</ol>
	<!--Breadcrumbs Close-->

	<!--Blog Sidebar Left-->
	<section class="blog">
		<div class="container">
			<div class="row">

				<!--Sidebar-->
				<div class="col-lg-3 col-md-3">
					<a style="border: 1px solid black" href="ads">Minu kuulutused</a> <span
						style="border: 1px solid green">Minu konto</span>
				</div>

				<!--Left Column-->
				<section class="catalog-grid">
					<h2 class="title">Minu konto</h2>
					<div class="col-lg-9 col-md-9" style="border: 1px solid grey">
						<style type="text/css">
td {
	padding: 10px
}

.esimene {
	width: 330px
}
</style>
             	<?php $secure  = $_SESSION['token'];$get = mysqli_query($con, "SELECT * FROM users WHERE secure='$secure'");$array = mysqli_fetch_array($get);?>
				<table>
							<tr>
								<td class="esimene">E-posti aadress</td>
								<td class="esimene" id="email2"><?php echo $array['email'];?></td>
								<td><a onclick="$('#emailModal').modal()">Muuda</a></td>
							</tr>
							<tr>
								<td class="esimene">Mobiiltelefon</td>
								<td class="esimene" id="mobile"><?php echo $array['phone'];?></td>
								<td><a onclick="$('#phoneModal').modal()">Muuda</a></td>
							</tr>
							<tr>
								<td class="esimene">Isiklikud andmed</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="esimene">Nimi</td>
								<td class="esimene" id="name2"><?php echo $array['fullname'];?></td>
								<td><a onclick="$('#nameModal').modal()">Muuda</a></td>
							</tr>
							<tr>
								<td class="esimene">Elukoht</td>
								<td class="esimene" id="state2"><?php echo $array['state'];?></td>
								<td><a onclick="$('#stateModal').modal()">Muuda</a></td>
							</tr>
							<tr>
								<td class="esimene">Parool</td>
								<td class="esimene">*********</td>
								<td><a onclick="$('#pwdModal').modal()">Muuda</a></td>
							</tr>
							<tr style="border-top: 1px solclass grey">
								<td class="esimene">Konto staatus</td>
								<td class="esimene"><?php echo $array['activated'];?>
								
								<td>
								
								<td><a
									onclick="var bool = confirm('Kas soovid tõesti oma kasutaja \nkoos kõigi kuulutustega kustutada?');if(bool == true){$.get('http://tags.ee/ajax/delAcc.php',function(data, status){if(data == 'kustutatud'){setTimeout(function(){ $(location).attr('href', 'http://tags.ee');alert('Teie konto on kustutatud koos kõikide kuulutustega! :(');}, 4000);}else{alert(data);}})}">Kustuta</a></td>
							</tr>
						</table>
					</div>
				</section>
			</div>
		</div>
		<br>
		<br>
	</section>
	<!--Blog Sidebar Left Close-->
</div>
<?php foot();?>
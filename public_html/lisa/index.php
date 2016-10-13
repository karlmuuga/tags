<?php

error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );
session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( "Location: /sisene" );
} else {
	
	include '../includes/h.php';
}
head ( "TAGs kuulutuse lisamine" );
?>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="upl.js"></script>
<link rel="stylesheet" href="style.css">

<div class="modal fade" id="modal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h2>Lae pilt üles</h2>
			</div>
			<div class="modal-body">
				<form id="uploadimage" action="" method="post"
					enctype="multipart/form-data">
					<div id="image_preview">
						<img id="previewing" src="blank.gif">
					</div>
					<div id="selectImage">
						<label>Vali pilt kuulutuse kõrvale</label><br /> <input
							type="file" name="file" id="file" />
						<hr>
						<!--label>Vali lisapildid (pole kohustuslik)</label><br/>
			<input type="file" name="file2" id="file2"/><hr>
			<input type="file" name="file3" id="file3"><hr>
			<input type="file" name="file4" id="file4"><hr-->
						<input type="submit" value="Lae üles" class="submit" />
					</div>
				</form>
			</div>
			<h4></h4>
			<div id="message"></div>
			<button onclick="$('#modal').modal('toggle')" class="btn btn-black">Sulge</button>


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
		<li>TAGs kuulutse lisamine</li>
	</ol>
	<!--Breadcrumbs Close-->
	<section style="padding: 15px">
		<form>
			<h1>Lisa kuulutus</h1>

			<hr>

			<div>
				<h2>Kategooria valimine</h2>
				<select id="kategooria">
					<option value="Festival">Festival</option>
					<option value="Kino">Kino</option>
					<option value="Muusika">Muusika</option>
					<option value="Teater">Teater</option>
					<option value="Sport">Sport</option>
					<option value="Kinkekaardid">Kinkekaardid</option>
					<option value="Muu">Muu</option>
				</select>
			</div>
			<hr>
			<div>
				<h2>Toimumise kuupäev</h2>
				<span>Kuulutus eemaldatakse peale toimumisaja lõppu.</span> <input
					type="text" style="width: 90px" placeholder="Kuupäev"
					class="datepicker" id="kuup2ev" readonly> <input
					style="width: 70px" type="text" id="time" placeholder="21.00"><br>
				<span>Kuupäev sisestada formaadis kuu/päev/aasta. Kellaaeg sisestada
					formaadis TT.MM</span>
			</div>
			<hr>
			<div>
				<h2>Pealkiri ja kirjeldus</h2>
				<input style="width: 400px;" type="text"
					placeholder="Ürituse pealkiri" id="pealkiri"><br>
				<span style="color: #ff6666">Pealkiri ei tohi sisaldada sõnu "Müüa"
					vms</span> <br>
				<textarea style="width: 400px; margin-top: 20px" rows="4"
					id="kirjeldus" placeholder="Lühikirjeldus"></textarea>
			</div>
			<hr>
			<div>
				<h2>Ürituse asukoht</h2>
				<select id="asukoht">
					<option>Harjumaa</option>
					<option>Ida-Virumaa</option>
					<option>Lääne-Virumaa</option>
					<option>Tartumaa</option>
					<option>Pärnumaa</option>
					<option>Viljandimaa</option>
					<option>Raplamaa</option>
					<option>Võrumaa</option>
					<option>Saaremaa</option>
					<option>Jõgevamaa</option>
					<option>Järvamaa</option>
					<option>Läänemaa</option>
					<option>Hiiumaa</option>
					<option>Põlvamaa</option>
					<option>Valgamaa</option>
				</select> <br>
				<h2>Ürituse aadress</h2>
				<input style="width: 400px" id="aadress" type="text"
					placeholder="Aadress">
			</div>
			<hr>
			<div>
				<h2>Pilt</h2>
				<button class="btn btn-black" id="sel">Vali pilt</button>
				<input type="text" id="pic" style="display: none">

			</div>
			<hr>
			<div>
				<h2>Pileti tüüp</h2>
				<select id="type">
					<option selected>Pole</option>
					<option>Tavapilet</option>
					<option>Sooduspilet</option>
				</select>
			</div>
			<hr>
			<div>
				<h2>Hind ja kogus</h2>
				<style type="text/css">
.euro::after {
	content: '€';
	margin-left: -30px;
}

.tk::after {
	content: 'tükki';
	margin-left: -40px;
}
</style>
				</select>
				<div class="euro">
					<input type="text" id="hind" placeholder="Hind eurodes">
				</div>
				<br>
				<div class="tk">
					<input type="text" id="kogus" placeholder="Piletite kogus">
				</div>
			</div>
			<hr>
			<!--div>
			<h2>Lisateenused</h2>
			<section class="catalog-single"><span>Mitu päeva soovite oma kuulutust esilehel reklaamida?</span>
			<div class="buttons group">
			
                <div class="qnt-count">
                  <a class="incr-btn nupp">-</a>
                  <input class="form-control" id="ad1" type="text" value="0">
                  <a class="incr-btn nupp">+</a><span id="had1" style="margin-left: 15px;font-size: 25px">€0.00</span>
                </div>
              </div>
			  <span>Mitu päeva soovite kasutada paksus trükis pealkirja?</span>
			
			<div class="buttons group">
                <div class="qnt-count">
                  <a class="incr-btn nupp">-</a>
                  <input class="form-control" id="ad2" type="text" value="0">
                  <a class="incr-btn nupp">+</a><span id="had2" style="margin-left: 15px;font-size: 25px">€0.00</span>
                </div>
              </div>
			  </section>
			<br>
			<h3 id="had">Hind kokku: 0€</h3>
			</div-->
			<br>
			<br>
			<br>
			<h3 id="back">Kui oled oma andmetes veendunud, postita kuulutus!</h3>
			<button id="adadd" class="btn btn-black">Postita</button>
		</form>
	</section>
</div>
<script src="/js/jquery.knob.js"></script>
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<?php foot();?>
<?php error_reporting(E_ALL); ini_set('display_errors', 1);session_start();

if(isset($_SESSION['token']) && isset($_GET['id'])){
	include $_SERVER['DOCUMENT_ROOT'].'/includes/c.php';
	$secure = $_SESSION['token'];
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	if($select){
		$arv = mysqli_num_rows($select);
		if($arv == 1){
			$arr = mysqli_fetch_array($select);
			$uid = $arr['id'];
			
			$id = mysqli_real_escape_string($con,$_GET['id']);
			$query = mysqli_query($con,"SELECT * FROM ads WHERE id='$id' AND uid='$uid'");
			
			if($query){
				$num = mysqli_num_rows($query);
				if($num == 1){
					$a = mysqli_fetch_array($query);
					$cat = $a['cat'];
					$date = $a['date'];
					$time = $a['time'];
					$title = $a['title'];
					$descri = $a['descri'];
					$state = $a['state'];
					$addr = $a['addr'];
					$pic = urldecode($a['pic']);
					$price = $a['price'];
					$qty = $a['qty'];
					$type = $a['type'];
					
					$Harjumaa = "";
					$Ida_Virumaa = "";
					$Lääne_Virumaa = "";
					$Tartumaa = "";
					$Pärnumaa = "";
					$Viljandimaa = "";
					$Raplamaa = "";
					$Võrumaa = "";
					$Saaremaa = "";
					$Jõgevamaa = "";
					$Järvamaa = "";
					$Läänemaa = "";
					$Hiiumaa = "";
					$Põlvamaa = "";
					$Valgamaa = "";
					
					switch($state){
						case "Harjumaa":
							$Harjumaa = "selected";
							break;
						case "Ida-Virumaa":
							$Ida_Virumaa = "selected";
							break;
						case "Lääne-Virumaa":
							$Lääne_Virumaa = "selected";
							break;
						case "Tartumaa":
							$Tartumaa = "selected";
							break;
						case "Pärnumaa":
							$Pärnumaa = "selected";
							break;
						case "Viljandimaa":
							$Viljandimaa = "selected";
							break;
						case "Raplamaa":
							$Raplamaa = "selected";
							break;
						case "Võrumaa":
							$Võrumaa = "selected";
							break;
						case "Saaremaa":
							$Saaremaa = "selected";
							break;
						case "Jõgevamaa":
							$Jõgevamaa = "selected";
							break;
						case "Järvamaa":
							$Järvamaa = "selected";
							break;
						case "Läänemaa":
							$Läänemaa = "selected";
							break;
						case "Hiiumaa":
							$Hiiumaa = "selected";
							break;
						case "Põlvamaa":
							$Põlvamaa = "selected";
							break;
						case "Valgamaa":
							$Valgamaa = "selected";
							break;
					}
					
				$Festival = "";
				$Kino = "";
				$Muusika = "";
				$Teater = "";
				$Sport = "";
				$Kinkekaardid = "";
				$Muu = "";
					
					switch($cat){
						case "Festival":
							$Festival = "selected";
							break;
						case "Kino":
							$Kino = "selected";
							break;
						case "Muusika":
							$Muusika = "selected";
							break;
						case "Teater":
							$Teater = "selected";
							break;
						case "Sport":
							$Sport = "selected";
							break;
						case "Kinkekaardid":
							$Kinkekaardid = "selected";
							break;
						case "Muu":
							$Muu = "selected";
							break;
						
					}
					
					$tava = "";
					$none = "selected";
					$soodus = "";
					switch($type){
						case "Tavapilet":
							$none = "";
							$tava = "selected";
							break;
						case "Sooduspilet":
							$none = "";
							$soodus = "selected";
							break;
					}
					$skrip = '$("#pic").val("http://tags.ee/img/none.jpg");$("#previewing").attr("src","http://tags.ee/img/none.jpg");';
echo "
      <div class='modal-dialog' style='width:90%'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'><i class='fa fa-times'></i></button>
            <h2>Muuda kuulutust</h2>
          </div>
          <div class='modal-body'>
          <form id='uploadimage' action='' method='post' enctype='multipart/form-data'>
				<div>
			<h2>Kategooria</h2>
			<select id='kategooria'>
				<option value='Festival' $Festival>Festival</option>
				<option value='Kino' $Kino>Kino</option>
				<option value='Muusika' $Muusika>Muusika</option>
				<option value='Teater' $Teater>Teater</option>
				<option value='Sport' $Sport>Sport</option>
				<option value='Kinkekaardid' $Kinkekaardid>Kinkekaardid</option>
				<option value='Muu' $Muu>Muu</option>
			</select>
			</div>
			<hr>
			<div>
			<h2>Toimumise kuupäev</h2><span>Kuulutus eemaldatakse peale toimumisaja lõppu.</span>
			<input class='datepicker' type='text' style='width:90px' placeholder='Kuupäev' id='kuup2ev' value='$date' required>
			<input style='width:70px' type='text' id='time' placeholder='21.00' value='$time' required><br><span>Kuupäev sisestada formaadis kuu/päev/aasta. Kellaaeg sisestada formaadis TT.MM</span>
			</div>
			<hr>
			<div>
			<h2>Pealkiri ja kirjeldus</h2>
			<input style='width: 400px;' type='text' placeholder='Ürituse pealkiri' id='pealkiri' value='$title' required><br><span style='color: #ff6666'>Pealkiri ei tohi sisaldada sõnu 'Müüa' vms</span>
			<br><textarea style='width:400px;margin-top: 20px' rows='4' id='kirjeldus' placeholder='Lühikirjeldus'>$descri</textarea>
			</div>
			<hr>
			<div>
			<h2>Ürituse asukoht</h2>
			<select id='asukoht'>
                <option $Harjumaa>Harjumaa</option>
                <option $Ida_Virumaa>Ida-Virumaa></option>
                <option $Lääne_Virumaa>Lääne-Virumaa</option>
                <option $Tartumaa>Tartumaa</option>
                <option $Pärnumaa>Pärnumaa</option>
                <option $Viljandimaa>Viljandimaa</option>
                <option $Raplamaa>Raplamaa</option>
                <option $Võrumaa>Võrumaa</option>
                <option $Saaremaa>Saaremaa</option>
                <option $Jõgevamaa>Jõgevamaa</option>
                <option $Järvamaa>Järvamaa</option>
                <option $Läänemaa>Läänemaa</option>
                <option $Hiiumaa>Hiiumaa</option>
				<option $Põlvamaa>Põlvamaa</option>
				<option $Valgamaa>Valgamaa</option>
			</select>
			<br>
			<h2>Ürituse aadress</h2><input style='width: 400px' id='aadress' type='text' placeholder='Aadress' value='$addr' required>		
			</div>
			<hr>
			<div>
				<h2>Pilt</h2>
				<div class='modal-body'>
			<form id='uploadimage' action='' method='post' enctype='multipart/form-data'>
			<div id='image_preview'><img id='previewing' src='$pic' style='width:300px'></div>
			<div id='selectImage'>
			<label>Vali pilt kuulutuse kõrvale</label><br/>
			<input type='file' name='file' id='file'  class='btn btn-black' /><br>
			<!--label>Vali lisapildid (pole kohustuslik)</label><br/>
			<input type='file' name='file2' id='file2'/><hr>
			<input type='file' name='file3' id='file3'><hr>
			<input type='file' name='file4' id='file4'><hr-->
			<input type='text' id='pic' style='display:none' value='$pic'>
			<button onclick='$skrip' class='btn btn-black'>Eemalda</button>
			<input type='submit' class='btn btn-black' value='Lae üles' class='submit' />
			</div>
			</form>
			</div>
			<div id='message'></div>
          
				
				<script src='upl.js'></script>
			</div>
			<hr>
			<div>
				<h2>Pileti tüüp</h2>
				<select id='type'>
				<option $none>Pole</option>
				<option $tava>Tavapilet</option>
				<option $soodus>Sooduspilet</option>
				</select>
				
			</div>
			<hr>
			<div>
				<h2>Hind ja kogus</h2>
				<style type='text/css'>
				.euro::after{
					content: '€';
					margin-left: -30px;
				}
				.tk::after{
					content: 'tükki';
					margin-left: -40px;
				}
				</style>
				</select>
				<div class='euro'><input type='text' id='hind' placeholder='Hind eurodes' value='$price' required></div>
				<br><div class='tk'><input type='text' id='kogus' placeholder='Piletite kogus' value='$qty' required></div>
				<input type='text' style='display:none' id='getId' value='$id'>
				<h2 id='back'></h2>
			</div>
		  
            <a id='muuda' class='btn btn-black' href='#'>Muuda kuulutust</a>
          </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->";
	  
	  
	  
	  echo '<script>
	  $("#muuda").click (function(e){
		e.preventDefault();
	var cat = $("#kategooria").val();
	var id = $("#getId").val();
	$("#"+id+".sale").html(cat);
	var date = $("#kuup2ev").val();
	var time = $("#time").val();
	var title = $("#pealkiri").val();
	$("#"+id+".title").html(title);
	var descri= $("#kirjeldus").val();
	var state = $("#asukoht option:selected").text();
	var addr = $("#aadress").val();
	$("#"+id+".addr").html(addr);
	var price = $("#hind").val();
	$("#"+id+".price-label").html(price+" €");
	var qty = $("#kogus").val();
	var type = $("#type option:selected" ).text();
	var pic = $("#pic").val();
	$("#"+id+" img").attr("src",pic);
	
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
			id: id,
			type: type
		},
		function(data, status){
			if(status == "success"){
				$("#back").html(data);setTimeout(function(){$("#adModal").modal("hide");},3000);
			}else{
				$("#back").html("Päring nurjus, võtke administraatoriga ühendust");$("#back").css("color","red");
			}
		});
		
});</script>';
				}
			}else{
				echo 'Midagi läks valesti..';
			}
		}
	}else{
		die(mysqli_error($con));
	}
}
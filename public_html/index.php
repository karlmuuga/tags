<?php

session_start ();
include "includes/h.php";

if (! isset ( $_GET ['id'] )) {
	head ( "TAGs" );
	ava ();
} else {
	
	$id = mysqli_real_escape_string ( $con, $_GET ['id'] );
	$result = mysqli_query ( $con, "SELECT * FROM ads WHERE id='$id'" );
	
	if ($result) {
		
		if (mysqli_num_rows ( $result ) != 0) {
			
			while ( $array = mysqli_fetch_array ( $result ) ) {
				$id = $array ['id'];
				$uid = $array ['uid'];
				$title = $array ['title'];
				head ( "TAGs - $title" );
				$price = $array ['price'];
				$desc = $array ['descri'];
				$qty = $array ['qty'];
				$uid = $array ['uid'];
				$cat = $array ['cat'];
				$date = $array ['date'];
				$pic = urldecode ( $array ['pic'] );
				$time = $array ['time'];
				$addr = $array ['addr'];
				$state = $array ['state'];
				$type = $array ['type'];
				
				$getname = mysqli_query ( $con, "SELECT * FROM users WHERE id='$uid'" );
				if ($getname && mysqli_num_rows ( $getname ) > 0) {
					
					$good = mysqli_fetch_array ( $getname );
					$name = "'" . $good ['fullname'] . "'";
					$email = "'" . $good ['email'] . "'";
					$phone = "'" . $good ['phone'] . "'";
				} else {
					$name = "Tundmatu";
				}
				
				echo '
				
					    <!--Page Content-->
    <div class="page-content">
    
      <!--Breadcrumbs-->
      <ol class="breadcrumb">
        <li><a href="/ads">Kõik kuulutused</a></li>
        <li><a href="/?id=' . $id . '">' . $title . '</a></li>
      </ol><!--Breadcrumbs Close-->
      
      <!--Catalog Single Item-->
      <section class="catalog-single">
		
      	<div class="container">
            <a onclick="window.history.back();return false;">Tagasi eelmisele lehele</a>
          <div class="row">
            <!--Product Description-->
            <div class="col-lg-6 col-md-6" style="background:rgb(222,222,222)">
              <h1>' . $title . '</h1>
              <!--div class="old-price">815,00 $</div-->
              <div class="price">Hind: ' . $price . ' €</div> <p class="p-style2">' . $desc . '</p>
              <p class="p-style2"><span style="color: #607D8A">Alles on:</span> ' . $qty . '</p>
              <p class="p-style2"><span style="color: #607D8A">Üritus toimub:</span> ' . $date . ' kell ' . $time . ' ' . $state . ' maakonnas</p>
              ';
				if ($addr != "") {
					echo '<p class="p-style2"><span style="color: #607D8A">Ürituse aadress:</span> ' . $addr . '</p>';
				}
				if ($type != "Pole") {
					echo '<p class="p-style2"><span style="color: #607D8A">Pileti tüüp:</span> ' . $type . '</p>';
				}
				echo '
              <p class="p-style2"><a onclick="$(this).html(' . $name . ')">Näita omaniku nime</a></p>
			  <p class="p-style2"><a onclick="$(this).html(' . $email . ')">Näita omaniku meiliaadressi</a></p>
			  <p class="p-style2"><a onclick="$(this).html(' . $phone . ')">Näita omaniku telefoninumbrit</a></p>
			  
              <!--div class="row">
                <div class="col-lg-4 col-md-4 col-sm-5">
                  <h3>Tell friends</h3>
                  <div class="social-links">
                    <a href="#"><i class="fa fa-tumblr-square"></i></a>
                    <a href="#"><i class="fa fa-pinterest-square"></i></a>
                    <a href="#"><i class="fa fa-facebook-square"></i></a>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-7">
                  <h3>Tags</h3>
                  <div class="tags">
                    <a href="#">Backpack</a>, 
                    <a href="#">Chanel</a>, 
                    <a href="#">Wristlet</a>
                  </div>
                </div>
              </div-->
              <div class="promo-labels">
                <div data-content="Teil on võimalik pilet saada kätte otse omanikult!"><i class="fa fa-truck"></i>Otse omanikult!</div>
                <!--div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-space-shuttle"></i>Kokkuleppeline kätt</div>
                <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-shield"></i>Safe Buy</div-->
              </div>
            </div>
          
          	<!--Product Gallery-->
            <div class="col-lg-6 col-md-6">
            	<div class="prod-gal master-slider" id="prod-gal">
              	<!--Slide1-->
                <div class="ms-slide">
                	<img src="' . $pic . '" data-src="' . $pic . '" alt="Lorem ipsum"/>
                  <img class="ms-thumb" src="';
				if ($pic == "http://tags.ee/img/none.jpg") {
					echo "http://tags.ee/img/none.png";
				} else {
					echo $pic;
				}
				echo '" alt="thumb" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><!--Catalog Single Item Close-->
    </div><!--Page Content Close-->
				
			';
			}
		} else {
			header ( "Location: http://www.tags.ee/bad/404" );
		}
	}
}
foot ();

?>
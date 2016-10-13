<?php //error_reporting(E_ALL); ini_set('display_errors', 1);
$con = mysqli_connect("5.10.94.13", "tagsite_tagsite", "ZxnLqBNjAbBfUqx4", "tagsite_tags");
if(!$con){echo 'Could not connect: '.mysqli_error($con);}else{mysqli_set_charset($con, 'utf8');}

$login = false;
if (isset($_SESSION['token'])){
	
	if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
		session_unset();
		session_destroy();
		header("Location: /");
	}
	
	$_SESSION['LAST_ACTIVITY'] = time();
	
	
	if(!isset($_SESSION['CREATED'])) {
		$_SESSION['CREATED'] = time();
	}elseif(time() - $_SESSION['CREATED'] > 600){
		session_regenerate_id(true);
		$_SESSION['CREATED'] = time();
	}
	
	$secure = $_SESSION['token'];
	$check = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if(!$check){
		
		die("Vabandust, kuid midagi läks valesti".mysqli_error($con));
		
	}else{
		
		if(mysqli_num_rows($check) == 0){
			session_unset();
			session_destroy();
			header("Location: /");
			
		}elseif(mysqli_num_rows($check) == 1){
			
			$login = true;
			
		}
	}
}




function ava(){
	echo '	<div class="page-content">
      <section class="hero-slider">

      	<div class="master-slider" id="hero-slider">

        	<div class="ms-slide" data-delay="7">

          	<div class="overlay"></div>

          	<img src="masterslider/blank.gif" data-src="/img/hero/slideshow/slide_1.jpg" alt="Slide 1"/>

            <h2 id="myy" class="dark-color ms-layer" style="width: 456px; left: 110px; top: 110px;color:white!important" data-effect="top(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">Müü enda pilet.<br>Osta teise pilet.</h2>

            <p style="width: 456px; left: 110px; top: 210px;color:white!important" class="dark-color ms-layer" data-effect="back(500)" data-duration="700" data-delay="500" data-ease="easeOutQuad">TAGs - piletid kätte hõlpsamalt ja soodsamalt, otse omanikult!.</p>

            <div style="left: 110px; top: 300px;" class="ms-layer button" data-effect="left(50,true)" data-duration="500" data-delay="750" data-ease="easeOutQuad"><a class="btn btn-black" href="/lisa" style="padding: 10px 27px">Lisa kuulutus</a></div>

            <div style="left: 350px; top: 300px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="700" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="/ads" style="padding: 10px 27px">Vaata kuulutusi</a></div>
          </div>
		  
		  <div class="ms-slide" data-delay="7">

          	<div class="overlay"></div>

          	<img src="masterslider/blank.gif" data-src="/img/hero/slideshow/slide_2.jpg" alt="Slide 2"/>

            <h2 id="myy" class="dark-color ms-layer" style="width: 456px; left: 110px; top: 110px;color:white!important" data-effect="top(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">Müü enda pilet.<br>Osta teise pilet.</h2>

            <p style="width: 456px; left: 110px; top: 210px;color:white!important" class="dark-color ms-layer" data-effect="back(500)" data-duration="700" data-delay="500" data-ease="easeOutQuad">TAGs - piletid kätte hõlpsamalt ja soodsamalt, otse omanikult!.</p>

            <div style="left: 110px; top: 300px;" class="ms-layer button" data-effect="left(50,true)" data-duration="500" data-delay="750" data-ease="easeOutQuad"><a class="btn btn-black" href="/lisa" style="padding: 10px 27px">Lisa kuulutus</a></div>

            <div style="left: 350px; top: 300px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="700" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="/ads" style="padding: 10px 27px">Vaata kuulutusi</a></div>
          </div>
		 </div> 
        </div>
      </section><img src="/img/s.jpg" style="width:100%"/>';
}
function head($title){
	global $login;
	echo '<!doctype html>

<html>

  <head>

    <meta charset="utf-8">

    <title>'.$title.'</title>

    <!--SEO Meta Tags-->

    <meta name="description" content="Osta ja müü ürituste pileteid" />

	<meta name="keywords" content="piletid, tickets, events" />

	<meta name="author" content="Karl-Hendrik Muuga" />

    <!--Mobile Specific Meta Tag-->

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!--Favicon-->

    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">

    <link rel="icon" href="/favicon.png" type="image/x-icon">

    <!--Master Slider Styles-->

    <link href="/masterslider/style/masterslider.css" rel="stylesheet" media="screen">

    <!--Styles-->

    <link href="/css/styles.css" rel="stylesheet" media="screen">

	<script src="/js/libs/jquery-1.11.1.min.js"></script>
    <!--Modernizr-->

		<script src="/js/libs/modernizr.custom.js"></script>

    <!--Adding Media Queries Support for IE8-->

    <!--[if lt IE 9]>

      <script src="/js/plugins/respond.js"></script>

    <![endif]-->

  </head>



  <!--Body-->

  <body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>

		<!--Login Modal-->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h2>Logi sisse või <a href="http://tags.ee/sisene">Registreeri</a></h2>
            <!--p class="large">Use social accounts</p>
            <div class="social-login">
              <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
              <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
              <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>
            </div-->
          </div>
          <div class="modal-body">
          <form class="login-form">
		  <span class="logmess"></span>
            <div class="form-group group">
              <label for="logemail">E-mail</label>
              <input type="email" class="form-control" id="logemail" placeholder="Sisestage oma e-mail" required>
              <!--a class="help-link" href="#">Forgot email?</a-->
            </div>
            <div class="form-group group">
              <label for="logpassword">Parool</label>
              <input type="password" class="form-control" id="logpassword" placeholder="Sisestage oma parool" required>
              <a class="help-link" href="http://tags.ee/recovery.php">Unustasite enda parooli?</a>
            </div>
            <div class="checkbox">
              <label><input style="position: relative;
bottom: 20px;
right: 15px" type="checkbox" name="remember" id="cboxlo"> Hoia mind sisse logituna</label>
            </div>
            <button class="btn btn-black" id="logis">Logi sisse</button>
          </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!--Header-->

    <header data-offset-top="500" data-stuck="600"><!--data-offset-top is when header converts to small variant and data-stuck when it becomes visible. Values in px represent position of scroll from top. Make sure there is at least 100px between those two values for smooth animation-->

    

      <!--Search Form-->

      <form class="search-form closed" method="get" role="form" autocomplete="off" action="/otsi">

      	<div class="container">

          <div class="close-search"><i class="icon-delete"></i></div>

            <div class="form-group">

              <label class="sr-only" for="search-hd">Otsi toodet</label>

              <input type="text" class="form-control" name="mis" id="search-hd" placeholder="Otsi toodet">

              <button type="submit"><i class="icon-magnifier"></i></button>

          </div>

        </div>

      </form>

    

    	<!--Mobile Menu Toggle-->

      <div class="menu-toggle"><i class="fa fa-list"></i></div>



      <div class="container">

        <a class="logo" href="/"><img src="/img/uuslogo.png" alt="Limo"/></a>

      </div>

      

      <!--Main Menu-->

      <nav class="menu">

        <div class="container">

          

          <ul class="main">

          	<li class="hide-sm"><a href="/"><span>A</span>valeht</a></li><!--Class "has-submenu" for proper highlighting and dropdown-->   

          	<li class="hide-sm"><a href="/pood"><span>P</span>ood</a></li>

          	<li class="hide-sm"><a href="/uudised"><span>U</span>udised</a></li>

          	<li class="hide-sm"><a href="/meist"><span>M</span>eist</a></li>

          	<li class="hide-sm"><a href="/kkk"><span>KKK</span></a></li>

          </ul>



        </div>



        <div class="catalog-block">

          <div class="container">

            <ul class="catalog">

            	<li><a href="/ads/festival">Festival</a></li>

            	<li><a href="/ads/muusika">Muusika</a></li>

            	<li><a href="/ads/teater">Teater</a></li>

            	<li><a href="/ads/kino">Kino</a></li>

            	<li><a href="/ads/sport">Sport</a></li>

              <li><a href="/ads/kinkekaardid">Kinkekaardid</a></li>

			  <li><a href="/ads">Kõik</a></li>

            </ul>

          </div>

        </div>

      </nav>

      

      <div class="toolbar-container">

        <div class="container">  

          <!--Toolbar-->
		
		
          <div class="toolbar group">';
			if(!$login){echo '
            <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-profile"></i> <span><b>S</b>isene</span></a>';}else{echo '
			<a class="login-btn btn-outlined-invert" href="/logout.php"><i class="fa fa-sign-out" style="position: relative;
top: -3px"></i> <span><b>V</b>älju</span></a>';}


echo '
            <!--a class="btn-outlined-invert" href="/wishlist.html"><i class="icon-heart"></i> <span><b>W</b>ishlist</span></a-->   

			

			<a href="/lisa" class="login-btn btn-outlined-invert"><i class="fa fa-plus-square" style="position: relative;
top: -3px"></i> <span><b>U</b>us kuulutus</span></a>';   
			if($login){echo '<a class="login-btn btn-outlined-invert"  href="http://tags.ee/konto"><i style="position: relative;
top: -3px;" class="fa fa-tags"></i><span><b>K</b>onto</span></a>';}
			echo '<button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>

          </div><!--Toolbar Close-->

        </div>

      </div>

    </header><!--Header Close-->';
}
function foot(){
	
	echo '          <!--Sticky Buttons-->
    <div class="sticky-btns">
    	<form class="quick-contact ajax-form" id="quick_contact">
      	<h3>Kontakteeruge meiega</h3>
        <p class="text-muted">Siia vormi võite jätta enda kontaktandmed koos sõnumiga, et me saaksime teiega ühendust võtta.</p>
        <div class="form-group">
        	<label for="qc-name">Täisnimi</label>
          <input class="form-control input-sm" type="text" id="qc_name" placeholder="Sisestage oma täisnimi">
        </div>
        <div class="form-group">
        	<label for="qc-email">Teie e-mail</label>
          <input class="form-control input-sm" type="email" id="qc_email" placeholder="Sisestage enda e-mail">
        </div>
        <div class="form-group">
        	<label for="qc-message">Teie sõnum</label>
          <textarea class="form-control input-sm" id="mes_m" placeholder="Sisestage enda sõnum"></textarea>
        </div>
        <p style="font-size:17px" id="return_m"></p>
        <button class="btn btn-black btn-sm btn-block" id="mess">Saada</button>
      </form>
    	<span id="qcf-btn"><i class="fa fa-envelope"></i></span>
      <span id="scrollTop-btn"><i class="fa fa-chevron-up"></i></span>
    </div>
    
    <section class="subscr-widget gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-8 col-sm-8">
            <h2>Liituge uudiskirjaga</h2>
            <form class="subscr-form" role="form" autocomplete="off">
              <div class="form-group">
                <label class="sr-only" for="subscr-email">Sisestage oma e-mail</label>
                <input type="email" class="form-control" name="subscr-email" id="subscr-email" placeholder="Sisestage oma e-mail" required>
                <button type="submit" id="subscr-submit"><i class="icon-check"></i></button>
				
              </div>
            </form><h3 id="retmessage"></h3>
            <p class="p-style2">Palun täitke väli enne jätkamist</p>
          </div>
			  <script>
				$("#subscr-submit").click(function(e){
					e.preventDefault();
						var email = $("#subscr-email").val();
						$.get( "http://tags.ee/ajax/subscribe.php?email="+email, function( data ) {
						if(data == "success"){
							$("#retmessage").html("Te olete edukalt lisatud nimekirja!");$("#retmessage").css("color","green");
						}else{
							$("#retmessage").html(data).css("color","red");
						}
					});
				});
			  </script>
          <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1">
            <p class="p-style3">Liitudes meie uudiskirjaga,
saad infot tulevaste ürituste, suuremate meelelahutussündmuste ning parimate pakkumiste kohta!</p>
          </div>
        </div>
      </div>
    </section><!--Subscription Widget Close-->
  	<!--Footer-->
    <footer class="footer">
    	<div class="container">
      	<div class="row">
        	<div class="col-lg-5 col-md-5 col-sm-5">
          	<div class="info">
              <a class="logo" href="/"><img src="/img/pealogo.png" alt="TAGs"/></a>
              <p style="font-size: 13px">TAGs - piletid kätte hõlpsamalt ja soodsamalt, otse omanikult!</p>
              <!--div class="social">
              	<a href="/#" target="_blank"><i class="fa fa-instagram"></i></a>
              	<a href="/#" target="_blank"><i class="fa fa-youtube-square"></i></a>
              	<a href="/#" target="_blank"><i class="fa fa-tumblr-square"></i></a>
              	<a href="/#" target="_blank"><i class="fa fa-vimeo-square"></i></a>
              	<a href="/#" target="_blank"><i class="fa fa-pinterest-square"></i></a>
              	<a href="/#" target="_blank"><i class="fa fa-facebook-square"></i></a>
              </div-->
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
			<div class="fb-page" data-href="https://www.facebook.com/TAGs-1465768407051255/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>          </div>
          <div class="contacts col-lg-3 col-md-3 col-sm-3">
          	<h2>Kontakt</h2>
            <p class="p-style3">
            	Raua 6, Tallinn, Eesti<br/>
				info [ät] tags.ee<br/>
              +372 534 771 97
            </p>
			<style>
				#meist{
					color:white
				}
				#meist:hover{
					border: 1px solid white
				}
			</style>
			<a class="btn btn-black" id="meist" href="http://tags.ee/meist">MEIST</a>
          </div>
        </div>
        <div class="copyright">
        	<div class="row">
          	<div class="col-lg-7 col-md-7 col-sm-7">
              <p>&copy; 2015 TAGs. Kõik õigused kaitstud.</p>
            </div>
          	<!--div class="col-lg-5 col-md-5 col-sm-5">
            	<div class="payment">
                <img src="/img/payment/visa.png" alt="Visa"/>
                <img src="/img/payment/paypal.png" alt="PayPal"/>
                <img src="/img/payment/master.png" alt="Master Card"/>
                <img src="/img/payment/discover.png" alt="Discover"/>
                <img src="/img/payment/amazon.png" alt="Amazon"/>
              </div>
            </div-->
          </div>
        </div>
      </div>
    </footer><!--Footer Close-->
    
    <!--Javascript (jQuery) Libraries and Plugins-->
		<script src="/js/libs/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="/js/libs/jquery.easing.min.js"></script>
		<script src="/js/plugins/bootstrap.min.js"></script>
		<script src="/js/plugins/smoothscroll.js"></script>
		<script src="/js/plugins/jquery.validate.min.js"></script>
		<script src="/js/plugins/icheck.min.js"></script>
		<script src="/js/plugins/jquery.placeholder.js"></script>
		<script src="/js/plugins/jquery.stellar.min.js"></script>
		<script src="/js/plugins/jquery.touchSwipe.min.js"></script>
		<script src="/js/plugins/jquery.shuffle.min.js"></script>
		<script src="/js/plugins/lightGallery.min.js"></script>
		<script src="/js/plugins/owl.carousel.min.js"></script>
		<script src="/js/plugins/masterslider.min.js"></script>
		<script src="/js/plugins/jquery.nouislider.min.js"></script>
		<script src="/js/scripts.js"></script>
		
<script type="text/javascript">

                $(document).ready(

                    function () {

                      

                      $( ".datepicker" ).datepicker({

                        changeMonth: true,

                        changeDay: true

                      });


                      $( "#datepicker" ).datepicker( "option", "dayNamesMin", ["P" ,"E", "T", "K", "N", "R", "L"] );

                      $( "#datepicker" ).datepicker( "option", "monthNamesShort", [ "Jan", "Veb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dets" ]);

                    }

                );

            </script>
    
  </body><!--Body Close-->
</html>';}?>
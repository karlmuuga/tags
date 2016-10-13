<?php $yest = date("Y-m-d",strtotime( '-1 days' ));$delete = mysqli_query($con,"DELETE FROM ads WHERE date BETWEEN CAST('2000-01-01' AS DATE) AND CAST('$yest' AS DATE)");
function ads($ads){
						echo "<p>Leiti ".mysqli_num_rows($ads)." kuulutus"; if(mysqli_num_rows($ads) != 1){echo"t";}echo ".</p>";
					
					while($massiiv = mysqli_fetch_array($ads)){
						$id = $massiiv['id'];
						$jsid = "'/?id=".$id."'";
						echo '
						
						<div class="row">
							<div class="col-lg-16 col-md-16 col-sm-16">
							  <div class="tile">
								<a href="/?id='.$id.'">
								  <img src="'.urldecode($massiiv['pic']).'" alt="Pilt" style="width:250px;padding: 10px"/>
								</a>
								<div class="badges">
								  <span class="sale">'.$massiiv['cat'].'</span>
								</div>
								<div class="price-label">'.$massiiv['price'].' €</div>
								<div class="footer">
								  <a href="/?id='.$id.'">'.$massiiv['title'].'</a>
								  <span>'.$massiiv['addr'].'</span>
								  <button class="btn btn-primary" onclick="location.href='.$jsid.'">Vaata lähemalt</button>
								</div>
							  </div>
							</div>
						</div>
						
						';
					}
}


function listem($crit){
echo '<!--Filters Modal-->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div>
          <div class="modal-body">
            <!--Here goes filters dynamically pasted by jQuery-->
          </div>
        </div>
      </div>
    </div>
    <!--Filters Toggle-->
    <div class="filter-toggle" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i></div>
    
    <!--Page Content-->
    <div class="page-content">
    
      <!--Breadcrumbs-->
      <ol class="breadcrumb">
        <li><a href="/">Avaleht</a></li>
        <li>TAGs kuulutused</li>
      </ol><!--Breadcrumbs Close-->
      
      <!--Catalog Grid-->
      <section class="catalog-grid">
      	<div class="container">
          <h2 class="with-sorting">Kõik TAGs kuulutused';
		  if($crit != "" && strpos($crit,"cat") !== false){echo " kategoorias ".substr($crit,10);}
		  echo '</h2>
          <div class="sorting">
            <a href="">Sorteeri aja järgi</a>
            <a href="">Sorteeri hinna järgi</a>
          </div>
          <div class="row">
          
            <!--Filters-->
          	<div class="filters-mobile col-lg-4 col-md-4 col-sm-4">
              <div class="shop-filters">
              	
                <!--Price Section-->
                <section class="filter-section">
                	<h3>Hinna järgi</h3>
                  <form name="price-filters">
                  	<span class="clear" id="clearPrice" >Tühista</span>
                    <div class="price-btns">
                      <a class="btn btn-black btn-sm" href="http://tags.ee/ads/odav">Alla 5€</a><br/>
                      <a class="btn btn-black btn-sm" href="http://tags.ee/ads/kesk">5€ kuni 30€</a><br/>
                      <a class="btn btn-black btn-sm" href="http://tags.ee/ads/kallis">üle 30€</a><br/>
                    </div>
                    <div class="price-slider">
                    	<div id="price-range"></div>
                      <div class="values group">
                      	<!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
                      	<input class="form-control" name="minVal" id="minVal" type="text" data-min-val="1" value="2">
                        <span class="labels">€ - </span>
                        <input class="form-control" name="maxVal" id="maxVal" type="text" data-max-val="200" value="50">
                        <span class="labels">€</span>
                      </div>
                      <button class="btn btn-primary" id="filPrice" style="width: 200px">Filtreeri</button>
                    </div>
                  </form>
                </section>
				
				<section class="filter-section">
					<h3>Kuupäeva järgi</h3>
					<form>
						<input class="datepicker" type="text" placeholder="Vali alguskuupäev" id="startDate" style="margin-bottom:10px">
						<input class="datepicker" type="text" placeholder="Vali lõppkuupäev" id="endDate">
						<button class="btn btn-primary" id="filDate" style="width: 200px;margin-top:15px">Filtreeri</button>
					</form>
                </section>
		<style>
			.kate .koht{
				
			}
		</style>
                
                <section class="filter-section">
                	<h3>Asukoha järgi</h3>
                  <span class="clear clearChecks">Tühista</span>
                  <label>
                    <input type="checkbox" class="koht">
                   Harjumaa</label>
                  <br>
                  <label>
                    <input type="checkbox" class="koht">
                    Ida-Virumaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Lääne-Virumaa</label>
                  <br>
                  <label>
                    <input type="checkbox" class="koht">
                    Tartumaa</label>
                  <br>
                  <label>
                    <input type="checkbox" class="koht">
                    Pärnumaa</label>
                  <br>
                  <label>
                    <input type="checkbox" class="koht">
                    Viljandimaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Raplamaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Võrumaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Saaremaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Jõgevamaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Järvamaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Läänemaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Hiiumaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Põlvamaa</label>
					<br>
                  <label>
                    <input type="checkbox" class="koht">
                    Valgamaa</label>
                </section>
              </div>
            </div>
            <!--Tiles-->
          	<div id="adView" class="col-lg-8 col-md-8 col-sm-8">';
			include $_SERVER['DOCUMENT_ROOT']."/includes/c.php";
			$today = date("Y-m-d");
			if($crit == ""){$p2rings = "SELECT * FROM ads WHERE date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE)";}else{
			$p2rings = "SELECT * FROM ads $crit AND date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE)";}
			$ads = mysqli_query($con,$p2rings);
			echo "<script>console.log(\"$p2rings\");</script>";
			if($ads){ads($ads);}
			echo '<!--Pagination>
              <ul class="pagination">
                <li class="prev-page"><a class="icon-arrow-left" href="/#"></a></li>
                <li class="active"><a href="/#">1</a></li>
                <li><a href="/#">2</a></li>
                <li><a href="/#">3</a></li>
                <li><a href="/#">4</a></li>
                <li class="next-page"><a class="icon-arrow-right" href="/#"></a></li>
              </ul-->
          </div>
        </div>
      </section><!--Catalog Grid Close-->
    
      <!--Brands Carousel Widget>
      <section class="brand-carousel">
        <div class="container">
          <h2>Brands in our shop</h2>
          <div class="inner">
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
            <a class="item" href="/#"><img src="/img/brands/1.png" alt="1"/></a>
          </div>
        </div>
      </section><Brands Carousel Close-->
      
    </div><!--Page Content Close--><script>
	
	$( document ).ready(function() {
		
		
	function price(){
			var min = $("#minVal").val();
			var max = $("#maxVal").val();
			if(($.isNumeric(min)) && ($.isNumeric(max))){
				
				$.get( "http://tags.ee/ajax/gAds.php?min="+min+"&max="+max';
				if($crit != "" && strpos($crit,"cat") === false){echo '+"&cat='.str_replace("'","",substr($crit,10)).'"';}
				echo ', function( data ) {
					if(data != ""){
						$("#adView").html(data);
					};
				});
			};
		}

	$("#filPrice").click(function(e){
		e.preventDefault();
		price();
	});

		$("#filDate").click(function(e){
			e.preventDefault();
			var start = $("#startDate").val();
			var end = $("#endDate").val();
			var min = $("#minVal").val();
			var max = $("#maxVal").val();
			if(($.isNumeric(min) && $.isNumeric(max)) && (start != "" || end != "")){
				
				$.get( "http://tags.ee/ajax/gAds.php?min="+min+"&max="+max+"&start="+start+"&end="';
				if($crit != ""){echo '+"&cat='.str_replace("'","",substr($crit,10)).'"';}
				echo ', function( data ) {
					if(data != ""){
						$("#adView").html(data);
					};
				});
			};
		});
		
		$(".koht").change(function(){
			
			
		});
		
		$(".kate").change(function(){
			
			
		});
	});
	
	</script>';
}
?>

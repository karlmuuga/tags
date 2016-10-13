<?php session_start();include '../includes/h.php';include '../includes/a.php';head("TAGs Otsing");if(!isset($_GET['search-hd'])){echo '<script>$(".search-form").removeClass("closed").addClass("open");</script>';}?>
<!--Filters Modal-->
<div class="modal fade" id="filterModal" tabindex="-1"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<!--Here goes filters dynamically pasted by jQuery-->
			</div>
		</div>
	</div>
</div>

<!--Filters Toggle-->
<div class="filter-toggle" data-toggle="modal"
	data-target="#filterModal">
	<i class="fa fa-filter"></i>
</div>

<!--Page Content-->
<div class="page-content">

	<!--Breadcrumbs-->
	<ol class="breadcrumb">
		<li><a href="/">Avaleht</a></li>
		<li>TAGs kuulutused</li>
	</ol>
	<!--Breadcrumbs Close-->

	<!--Catalog Grid-->
	<section class="catalog-grid">
		<div class="container">
		<?php
		if (! empty ( $_GET ['mis'] )) {
			$q = strtolower ( mysqli_real_escape_string ( $con, $_GET ['mis'] ) );
			$ads = mysqli_query ( $con, "SELECT * FROM ads WHERE title LIKE '%$q%' OR descri LIKE '%$q%'" );
			echo '<h2 class="with-sorting">Kõik TAGs kuulutused sisuga "' . $q . '"</h2>';
		} else {
			$ads = mysqli_query ( $con, "SELECT * FROM ads" );
			echo '<h2 class="with-sorting">Kõik TAGs kuulutused</h2>';
		}
		?>
          <div class="sorting">
				<a href="">Sorteeri aja järgi</a> <a href="">Sorteeri hinna järgi</a>
			</div>
			<div class="row">

				<!--Filters-->
				<div class="filters-mobile col-lg-4 col-md-4 col-sm-4">
					<div class="shop-filters">

						<!--Price Section-->
						<section class="filter-section">
							<h3>Hinna järgi</h3>
							<form method="get" name="price-filters">
								<span class="clear" id="clearPrice">Tühista</span>
								<div class="price-btns">
									<button class="btn btn-black btn-sm" value="below 50$">Alla 5€</button>
									<br />
									<button class="btn btn-black btn-sm" value="50$-100$">5€ kuni
										30€</button>
									<br />
									<button class="btn btn-black btn-sm" value="100$-300$">üle 30€</button>
									<br />
								</div>
								<div class="price-slider">
									<div id="price-range"></div>
									<div class="values group">
										<!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
										<input class="form-control" name="minVal" id="minVal"
											type="text" data-min-val="1" value="2"> <span class="labels">€
											- </span> <input class="form-control" name="maxVal"
											id="maxVal" type="text" data-max-val="200" value="50"> <span
											class="labels">€</span>
									</div>
									<input class="btn btn-primary btn-sm" type="submit"
										value="Filtreeri">
								</div>
							</form>
						</section>

						<section class="filter-section">
							<h3>Kuupäeva järgi</h3>
							<form method="get">
								<input class="datepicker" type="text"
									placeholder="Vali alguskuupäev" name="startDate"
									style="margin-bottom: 10px"> <input class="datepicker"
									type="text" placeholder="Vali lõppkuupäev" name="endDate">
							</form>
						</section>

						<section class="filter-section">
							<h3>Kategooriad</h3>
							<span class="clear clearChecks">Tühista</span> <label> <input
								type="checkbox" checked> Festival
							</label> <br> <label> <input type="checkbox" checked> Kino
							</label> <br> <label> <input type="checkbox" checked> Muusika
							</label> <br> <label> <input type="checkbox" checked> Teater
							</label> <br> <label> <input type="checkbox" checked> Sport
							</label> <br> <label> <input type="checkbox" checked>
								Kinkekaardid
							</label>
						</section>

						<section class="filter-section">
							<h3>Asukoha järgi</h3>
							<span class="clear clearChecks">Tühista</span> <label> <input
								type="checkbox"> Harjumaa
							</label> <br> <label> <input type="checkbox"> Ida-Virumaa
							</label> <br> <label> <input type="checkbox" name="sizes"
								value="red" id="size_4"> Lääne-Virumaa
							</label> <br> <label> <input type="checkbox"> Tartumaa
							</label> <br> <label> <input type="checkbox"> Pärnumaa
							</label> <br> <label> <input type="checkbox"> Viljandimaa
							</label> <br> <label> <input type="checkbox"> Raplamaa
							</label> <br> <label> <input type="checkbox"> Võrumaa
							</label> <br> <label> <input type="checkbox"> Saaremaa
							</label> <br> <label> <input type="checkbox"> Jõgevamaa
							</label> <br> <label> <input type="checkbox"> Järvamaa
							</label> <br> <label> <input type="checkbox"> Läänemaa
							</label> <br> <label> <input type="checkbox"> Hiiumaa
							</label> <br> <label> <input type="checkbox"> Põlvamaa
							</label> <br> <label> <input type="checkbox"> Valgamaa
							</label>
						</section>
					</div>
				</div>
				<!--Tiles-->
				<div class="col-lg-8 col-md-8 col-sm-8">
				<?php if($ads){ads($ads);}?>
				
			<!--Pagination>
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
	
	</section>
	<!--Catalog Grid Close-->

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

</div>
<!--Page Content Close-->
<?php foot();?>
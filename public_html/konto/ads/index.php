<?php session_start();include '../../includes/h.php';if(!isset($_SESSION['token'])){header("Location: /sisene/?b");}head("Minu konto");?>
<div class='modal fade' id='adModal' tabindex='-1' role='dialog'
	aria-hidden='true'></div>

<div class="page-content">

	<!--Breadcrumbs-->
	<ol class="breadcrumb">
		<li><a href="/">Avaleht</a></li>
		<li>Minu konto</li>
	</ol>
	<!--Breadcrumbs Close-->
	<section class="blog">
		<div class="container">
			<div class="row">
				<section class="catalog-grid">
					<div>
						<span style="border: 1px solid green">Minu kuulutused</span> <a
							style="border: 1px solid black" href="..">Minu konto</a>
					</div>
					<div class="col-lg-12 col-md-12"
						style="border: 1px solid black; margin-bottom: 20px">
						<h2 class="title">Minu kuulutused</h2>
						<div class="shop-filters">
							<div class="filter-section">
								<style type="text/css">
td {
	border: 1px solid grey;
	padding: 10px;
}

.ad {
	width: 800px
}
</style>
             	<?php
														$secure = $_SESSION ['token'];
														$get = mysqli_query ( $con, "SELECT * FROM users WHERE secure='$secure'" );
														$array = mysqli_fetch_array ( $get );
														$uid = $array ['id'];
														$ads = mysqli_query ( $con, "SELECT * FROM ads WHERE uid='$uid'" );
														if ($ads) {
															
															echo "<p>Teil on hetkel <span id='arv'>" . mysqli_num_rows ( $ads ) . "</span> kuulutus";
															if (mysqli_num_rows ( $ads ) != 1) {
																echo "t";
															}
															echo ".</p>";
															if (mysqli_num_rows ( $ads ) != 0) {
																echo '<table style="border: 1px solid grey">
								<tr>
									<td class="ad">Kuulutus</td>
									<td>Toimingud</td>
								</tr>';
																
																while ( $massiiv = mysqli_fetch_array ( $ads ) ) {
																	$id = $massiiv ['id'];
																	$title = $massiiv ['title'];
																	$jsid = "'/?id=" . $id . "'";
																	$script = "del('$id','$title')";
																	echo '
							<tr id="' . $id . '">
								
								<td class="ad">
									
										<div class="col-lg-16 col-md-16 col-sm-16">
							  <div class="tile">
								<a href="/?id=' . $id . '">
								  <img id="' . $id . '" src="' . urldecode ( $massiiv ['pic'] ) . '" alt="Pilt" style="width:250px;padding: 10px"/>
								</a>
								<div class="badges">
								  <span class="sale" id="' . $id . '">' . $massiiv ['cat'] . '</span>
								</div>
								<div class="price-label" id="' . $id . '">' . $massiiv ['price'] . ' €</div>
								<div class="footer">
								  <a href="/?id=' . $id . '" id="' . $id . '" class="title">' . $massiiv ['title'] . '</a>
								  <span class="addr" id="' . $id . '">' . $massiiv ['addr'] . '</span>
								  <button class="btn btn-primary" onclick="location.href=' . $jsid . '">Vaata lähemalt</button>
								</div>
							  </div>
							</div>
									
								</td>
								
								<td><button class="btn btn-primary" onclick="muuda(' . $id . ')">Muuda</button><br><br>
								<button class="btn btn-primary" onclick="' . $script . '">Eemalda</button></td>
							</tr>
							';
																}
																
																echo '</table>';
															}
														}
														?>
				</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</section>
	<!--Blog Sidebar Left Close-->
</div>
<script type="text/javascript" src="script.js"></script>
<?php foot();?>

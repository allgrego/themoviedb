<?php
/**
 * Trending Movies of the Today
 * @author Gregorio Alvarez <allgrego14@gmail.com>
 */

require('./components/Pagination.php');
require('./components/Rating.php');

$cred_ini = parse_ini_file('./library/credentials.ini');

$apikey = $cred_ini['apikey'];
$token = $cred_ini['token'];
$baseURI = $cred_ini['baseURI'];


$url = $baseURI.'/trending/movie/day';

// Page handler
if(empty($_GET['page'])||$_GET['page']<1){
	header("Location: "."./today.php?page=1");
}else{
	$current_page = $_GET['page'];
}
// cURL start
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url.'?page='.$current_page);

$header = array(
    'Authorization: Bearer '.$token,
    'Content-Type: application/json;charset=utf-8'
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$movieslist = curl_exec($curl);
curl_close($curl);
$moviesResponse = json_decode($movieslist);
// cURL end

// Result parameters
$movies = $moviesResponse->results;
$lastpage= $moviesResponse->total_pages;
$current_page = $moviesResponse->page;

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Multiverse of Movies</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/custom.css" />
		<!-- Add icon library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<script src="assets/js/custom.js"></script>
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header">
						<div class="progress-container">
							<div class="progress-bar" id="myBar"></div>
						</div>
						<?php pagination('./today.php',$current_page,$lastpage);?>
						<h1 class="title"><a href=""><strong>TRENDING MOVIES</strong> OF TODAY</a></h1>
						
						<nav>
							<ul>
								<li><a href="./week.php" class="icon solid fa-info-circle">See trending movies of the week</a></li>
								<li><a href="#footer" class="icon solid fa-info-circle">About</a></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
					<?php
						foreach($movies as &$movie){
							$title = $movie->title;
							$overview = $movie->overview;
							$posterpath = $cred_ini['imageBaseURI'].$movie->poster_path;
							$backdroppath = $cred_ini['imageBaseURI'].$movie->backdrop_path;
							$release_date = $movie->release_date;
							$vote_average = $movie->vote_average;
							

						?>
							<article class="thumb">
								<a href="<?php echo $posterpath; ?>" class="image"><img src="<?php echo $backdroppath;?>" alt="" /></a>
								<h2><?php echo $title ?></h2>
								<?php rating($vote_average); ?>
								<p>Release date: <?php echo $release_date ?></p>
								<p><?php echo $overview ?></p>
							</article>
						<?php
						}
					?>
					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2>Magna feugiat sed adipiscing</h2>
									<p>Nulla consequat, ex ut suscipit rutrum, mi dolor tincidunt erat, et scelerisque turpis ipsum eget quis orci mattis aliquet. Maecenas fringilla et ante at lorem et ipsum. Dolor nulla eu bibendum sapien. Donec non pharetra dui. Nulla consequat, ex ut suscipit rutrum, mi dolor tincidunt erat, et scelerisque turpis ipsum.</p>
								</section>
								<section>
									<h2>Follow me on</h2>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
									</ul>
								</section>
								<p class="copyright">									
									&copy;. Based on: <a href="http://html5up.net">HTML5 UP</a>.
								</p>
							</div>
							<div>
								<section>
									<h2>Get in touch</h2>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<input type="text" name="name" id="name" placeholder="Name" />
											</div>
											<div class="field half">
												<input type="text" name="email" id="email" placeholder="Email" />
											</div>
											<div class="field">
												<textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Send" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</form>
								</section>
							</div>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php


include('config.php');

include('functions.php');

$term = get('search-term');

$movies = getMovies($term, $database);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Movie Review</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css" >

</head>
<body>

	<div class="page">
		<div class="site-image">
		</div>
		<p class="thingy">Welcome Back: <font color="red"><?php echo $user['username'] ?></font></p>
		<p class="thingy2"><a href="logout.php">Log Out</a></p>
		<form method="GET" div class="search_bar">
			<input type="text" name="search-term" placeholder="Search..." />
			<input type="submit" style="visibility: hidden;" />
		</form>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<?php foreach($movies as $movie) : ?>
			<p>
				<a href="movie.php?movieID=<?php echo $movie['movieID']; ?>"><?php echo $movie['movieTitle']; ?></a>(<?php echo $movie['movieReleaseDate']; ?>)<br />
				<hr size="1" width="90%" align="left" color="black">
			</p>
		<?php endforeach; ?>
	</div>
</div>
</body>
</html>
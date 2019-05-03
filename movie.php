<?php

include('config.php');

include('functions.php');


$movieID = get('movieID');


$sql = file_get_contents('sql/getMovieTitle.sql');
$params = array(
	'movieID' => $movieID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$titles = $statement->fetchAll(PDO::FETCH_ASSOC);
$title = $titles[0];


$sql = file_get_contents('sql/getReviews.sql');
$params = array(
	'movieID' => $movieID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$reviews = $statement->fetchAll(PDO::FETCH_ASSOC);
$isempty=0;
if(empty($reviews))
{
	$isempty=1;
}
else
{
	$rev=$reviews[0];
}
	




?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Movie</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="page">
		<h1><?php echo $title['movieTitle'] ?></h1>
		<?php if($isempty==1) : ?>
			<p style="text-align:center";><i> Wow it looks like there aren't any reviews yet! maybe you should fix that... or don't. Whatever.</i></p>
		<?php endif; ?>
			<?php foreach($reviews as $review) : ?>
				<div><span>user: </span><span class="user"><?php echo $review['reviewAuthor']; ?></span><div>
				<p class="review"><?php echo $review['review']; ?></p>
				<?php if($review['score']==0) : ?>
					<pre> User Rating:<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></pre>
				<?php elseif($review['score']==1) : ?>
					<pre> User Rating:<span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></pre>
				<?php elseif($review['score']==2) : ?>
					<pre> User Rating:<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></pre>
				<?php elseif($review['score']==3) : ?>
					<pre> User Rating:<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></pre>
				<?php elseif($review['score']==4) : ?>
					<pre> User Rating:<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span></pre>
				<?php elseif($review['score']==5) : ?>
					<pre> User Rating:<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></pre>
				<?php endif; ?>
				<?php if($review['reviewAuthor']==$user['username']) : ?>
					<pre><a href="form.php?action=edit&reviewID=<?php echo $review['reviewID'] ?>&movieID=<?php echo $movieID ?>&movieTitle=<?php echo $rev['movieTitle'] ?>">edit your review!</a></pre><br />
				<?php endif; ?>
				<br />
			<?php endforeach; ?>
	<a href="form.php?action=add&movieID=<?php echo $movieID ?>&movieTitle=<?php echo $title['movieTitle'] ?>">add your own review!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Return to main</a>
	</div>
</body>
</html>
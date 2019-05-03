<?php

include('config.php');

include('functions.php');

$action = $_GET['action'];




$movieID = get('movieID');
$movieTitle = get('movieTitle');
$reviewAuthor = $user['username'];
$reviewID = get('reviewID');
if($action != "add")
{
	$rev = getReview($reviewID, $database);
	$r = $rev[0];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$movieID = $_POST['movieID'];
	$movieTitle = $_POST['movieTitle'];
	$reviewAuthor = $_POST['reviewAuthor'];
	$review = $_POST['review'];
	$score = $_POST['score'];
	
	if ($action == 'add') {
		$sql = file_get_contents('sql/addReview.sql');
        $params = array( 
            'movieID' => $movieID, 
			'movieTitle' => $movieTitle, 
			'reviewAuthor' => $reviewAuthor, 
			'review' => $review, 
			'score' => $score
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
	}
	
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/editReview.sql');
        $params = array( 
			'reviewID' =>$reviewID,
            'movieID' => $movieID, 
			'movieTitle' => $movieTitle, 
			'reviewAuthor' => $reviewAuthor, 
			'review' => $review, 
			'score' => $score
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
	}
	
	header("location: movie.php?movieID=$movieID");
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>add/edit</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="page">
		<?php if($action == 'add') : ?>
				<h1>Add your review!</h1>
		<?php else : ?>
				<h1>Edit your review!</h1>
		<?php endif; ?>
		<form action="" method="POST">
		
		<div class="form-element">
				<input type="hidden" name="movieID" class="boxy" value="<?php echo $movieID ?>" /></ br>
		</div>
		<div class="form-element">
			<label>movie Title:</label>
				<input readonly type="text" name="movieTitle" class="boxy" value="<?php echo $movieTitle ?>" /></ br>
		</div>
		<div class="form-element">
			<label>Reviewer:</label>
				<input readonly type="text" name="reviewAuthor" class="boxy" value="<?php echo $reviewAuthor ?>" /></ br>
		</div>
		
		<div class="form-element">
			<label>Rating (out of 5):</label>
				<select name="score" class="ratingselect">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
		</div>

			<div class="form-element">
				<label>review</label>
				<?php if($action == 'add') : ?>
				<input type="text" name="review" class="textbox"/>
				<?php else : ?>
				<input type="text" name="review" class="textbox" value="<?php echo $r['review']; ?>" />
				<?php endif; ?>
			</div>
			<div class="form-element">
				<input type="submit" class="button" />&nbsp;
				<input type="reset" class="button" />
			</div>
			<a href="movie.php?movieID=<?php echo $movieID; ?>">Cancel and Return</a><br />
		</form>
	</div>
</body>
</html>
<?php


function getMovies($term, $database) {
	$term ='%' . $term . '%';
	$sql = file_get_contents('sql/getMovie.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$movies = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $movies;
}

function getReview($term, $database){
	$term = $term . '%';
	$sql = file_get_contents('sql/getReview.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$review = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $review;
}

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	
	else {
		return '';
	}
}
?>
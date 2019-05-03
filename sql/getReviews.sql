SELECT *
FROM reviews
JOIN movies on movies.movieTitle = reviews.movieTitle
WHERE reviews.movieID = :movieID
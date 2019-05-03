UPDATE reviews
SET reviewID = :reviewID, movieID = :movieID, movieTitle = :movieTitle, reviewAuthor = :reviewAuthor, review = :review, score = :score
WHERE reviewID = :reviewID 
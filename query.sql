all posts
SELECT pl.pidx, pl.user_image, pl.name, pl.likedCnt, COUNT(c.pidx) commentsCnt, pl.title, pl.content, pl.post_image
FROM (
	SELECT u.user_image, u.name, p.title, p.content, p.post_image, COUNT(l.pidx) likedCnt, p.pidx
	FROM `post` p
		LEFT JOIN `user` u ON p.uidx = u.uidx
		LEFT JOIN `liked` l ON p.pidx = l.pidx
	GROUP BY l.pidx
) pl LEFT JOIN `comments` c ON pl.pidx = c.pidx
GROUP BY c.pidx

liked posts
SELECT *
FROM `post` p
LEFT JOIN `liked` l ON p.pidx = l.pidx
WHERE l.uidx = 1
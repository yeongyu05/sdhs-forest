/* 유저 */
SELECT * FROM `user`

/* 총 게시글 수 */
SELECT *, count(uidx) totalPost
FROM `post`
GROUP BY uidx

/* 총 게시물 좋아요 수 */
SELECT *, COUNT(p.uidx) totalPostLiked FROM `post` p
JOIN liked l on p.pidx = l.pidx
GROUP BY p.uidx

/* 총 게시물 댓글 수 */
SELECT *, COUNT(p.uidx) totalPostComments FROM `post` p
JOIN comments c ON p.pidx = c.pidx
GROUP BY p.uidx

/* 유저 통계 리스트 */
SELECT u.uidx, u.id, u.name, u.user_image, IFNULL(totalPost, 0) post, IFNULL(totalPostLiked, 0) liked, IFNULL(totalPostComments, 0) comments
FROM (SELECT uidx, id, name, user_image FROM `user`) u
LEFT JOIN (
	SELECT uidx, count(uidx) totalPost
	FROM `post` GROUP BY uidx
) p ON u.uidx = p.uidx
LEFT JOIN (
    SELECT post.uidx, COUNT(post.uidx) totalPostLiked FROM `post`
    JOIN liked on post.pidx = liked.pidx GROUP BY post.uidx
) l ON u.uidx = l.uidx
LEFT JOIN (
    SELECT post.uidx, COUNT(post.uidx) totalPostComments FROM `post`
    JOIN comments ON post.pidx = comments.pidx GROUP BY post.uidx
) c ON u.uidx = c.uidx
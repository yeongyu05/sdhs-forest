-- 총 게시글 순 --
SELECT * FROM `post`
JOIN `user` ON `post`.uidx = `user`.uidx
WHERE `user`.uidx = 1

-- 총 게시글 좋아요 순
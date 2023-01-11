SELECT *, count(l.pidx) AS likedCnt, count(c.pidx) AS commentsCnt
FROM `post` AS p
JOIN `user` AS u
ON p.uidx = u.uidx
JOIN `liked` AS l
ON p.pidx = l.pidx
JOIN `comments` AS c
ON p.pidx = c.pidx
GROUP BY l.pidx, c.pidx


count(c.pidx) AS commentsCnt

JOIN `comments` AS c ON p.pidx = c.pidx

SELECT *, count(l.pidx) AS likedCnt, count(c.pidx) AS commentsCnt
	FROM `post` AS p
		JOIN `user` AS u ON p.uidx = u.uidx
        JOIN `liked` AS l ON p.pidx = l.pidx	
        JOIN `comments` AS c ON p.pidx = c.pidx
GROUP BY l.pidx, c.pidx

SELECT *
	FROM `post` AS p
		JOIN `user` AS u ON p.uidx = u.uidx
        JOIN `liked` AS l ON p.pidx = l.pidx	
        JOIN `comments` AS c ON p.pidx = c.pidx



SELECT p.pidx, l.lidx
	FROM `post` AS p
		JOIN `user` AS u ON p.uidx = u.uidx
        JOIN `liked` AS l ON p.pidx = l.pidx	



pidx | lidx
1 | 1 
1 | 3 
2 | 2 
2 | 4 
2 | 5 


select *, count(c.pidx) commentCut from ( SELECT p.pidx, COUNT(l.pidx) likeCut
	FROM `post` p
		JOIN `user` u ON p.uidx = u.uidx
        JOIN `liked` l ON p.pidx = l.pidx	
    group by l.pidx
 ) pl JOIN `comments` c ON pl.pidx = c.pidx
	group by c.pidx



SELECT p.pidx, u.name, l.lidx, count(c.cidx), c.comment
	FROM `post` AS p
		JOIN `user` AS u ON p.uidx = u.uidx
        JOIN `liked` AS l ON p.pidx = l.pidx	
        JOIN `comments` AS c ON p.pidx = c.pidx
	group by c.cidx, c.pidx, l.lidx
 	order by p.pidx, l.lidx, c.cidx
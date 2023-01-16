<?php

namespace src\Controller;

class View {
    function main() {
        $posts = fetchAll("
            SELECT pl.pidx, pl.user_image, pl.name, pl.likedCnt, COUNT(c.pidx) commentsCnt, pl.title, pl.content, pl.post_image
            FROM ( SELECT u.user_image, u.name, p.title, p.content, p.post_image, p.pidx, COUNT(l.pidx) likedCnt
                FROM `post` p
                    LEFT OUTER JOIN `user` u ON p.uidx = u.uidx
                    LEFT OUTER JOIN `liked` l ON p.pidx = l.pidx
                GROUP BY p.pidx
            ) pl LEFT OUTER JOIN `comments` c ON pl.pidx = c.pidx
            GROUP BY pl.pidx
            ORDER BY pl.pidx
        ");
        view('main', ['posts' => $posts]);
    }
    function register() {
        if(ss()) move('/');
        view('auth/register');
    }
    function login() {
        if(ss()) move('/');
        view('auth/login');
    }
    function profile($url) {
        $uidx = $url[1];
        $user = fetch("SELECT `uidx`, `id`, `name`, `user_image` FROM `user` WHERE uidx = ?", [$uidx]);
        $written = fetchAll("
            SELECT pl.pidx, pl.user_image, pl.name, pl.likedCnt, COUNT(c.pidx) commentsCnt, pl.title, pl.content, pl.post_image
            FROM ( SELECT u.user_image, u.name, p.title, p.content, p.post_image, COUNT(l.pidx) likedCnt, p.pidx, u.uidx
                FROM `post` p
                    LEFT OUTER JOIN `user` u ON p.uidx = u.uidx
                    LEFT OUTER JOIN `liked` l ON p.pidx = l.pidx
                GROUP BY p.pidx
            ) pl LEFT OUTER JOIN `comments` c ON pl.pidx = c.pidx
            WHERE pl.uidx = ?
            GROUP BY pl.pidx
            ORDER BY pl.pidx
        ", [$uidx]);
        $liked = fetchAll("
            SELECT all_posts.* FROM (
                SELECT pl.pidx, pl.user_image, pl.name, pl.likedCnt, COUNT(c.pidx) commentsCnt, pl.title, pl.content, pl.post_image
                FROM (
                    SELECT u.user_image, u.name, p.title, p.content, p.post_image, COUNT(l.pidx) likedCnt, p.pidx
                    FROM `post` p
                    LEFT OUTER JOIN `user` u ON p.uidx = u.uidx
                    LEFT OUTER JOIN `liked` l ON p.pidx = l.pidx
                    GROUP BY p.pidx
                ) pl LEFT OUTER JOIN `comments` c ON pl.pidx = c.pidx
                GROUP BY pl.pidx
            ) all_posts JOIN (
                SELECT p.* FROM `post` p
                LEFT OUTER JOIN `liked` l ON p.pidx = l.pidx
                WHERE l.uidx = ?
            ) liked_posts ON all_posts.pidx = liked_posts.pidx
            ORDER BY all_posts.pidx
        ", [$uidx]);
        view('profile', ['user' => $user, 'written' => $written, 'liked' => $liked]);
    }
    function createPost() {
        if(!ss()) move('/login', '로그인을 원합니다');
        view('createPost');
    }
    function createPostCtrl() {
        extract($_POST);
        fetch('INSERT INTO `post`(`uidx`, `title`, `content`, `post_image`) VALUES (?,?,?,?)', [ss()->uidx, $title, $content, '']);
        move('/');
    }
    function detailPost($url) {
        $pidx = $url[1];
        $post = fetch("SELECT * FROM post WHERE pidx = ?", [$pidx]);
        $comments = fetchAll("SELECT * FROM `comments` WHERE pidx = ?", [$pidx]);
        view('detailPost', ['post' => $post, 'comments' => $comments]);
    }
    function editPost($url) {
        $pidx = $url[1];
        $post = fetch("SELECT * FROM `post` WHERE pidx = ?", [$pidx]);
        view('editPost', ['post' => $post]);
    }
    function editPostCtrl($url) {
        $pidx = $url[1];
        extract($_POST);
        fetch("UPDATE `post` SET `title`= ?, `content`=  ? WHERE `pidx` = ?", [$title, $content, $pidx]);
        move('/', '완료되었다 수정.');
    }
    function deletePost($url) {
        $pidx = $url[1];
        fetch("DELETE FROM `post` WHERE pidx=?", [$pidx]);
        move('/', '완료되었다 삭제.');
    }
    function writeComment($url) {
        $pidx = $url[1];
        extract($_POST);
        fetch("INSERT INTO `comments`(`pidx`, `uidx`, `comment`) VALUES (?,?,?)", [$pidx, ss()->uidx, $comment]);
        back();
    }
    function liked($url) {
        $pidx = $url[1];
        $uidx = ss()->uidx;
        $isLiked = fetch("SELECT * FROM `liked` WHERE pidx = ? AND uidx = ?", [$pidx, $uidx]);
        if($isLiked) {
            fetch("DELETE FROM `liked` WHERE pidx = ? AND uidx = ?", [$pidx, $uidx]);
            alert('취소되었다 좋아요.');
            back();
        }
        fetch("INSERT INTO `liked`(`pidx`, `uidx`) VALUES (?,?)", [$pidx, $uidx]);
        alert('좋아요를 원합니다.');
        back();
    }
}
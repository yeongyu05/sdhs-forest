<?php

namespace src\Controller;

class View {
    function main() {
        $posts = fetchAll("
            SELECT pl.user_image, pl.name, pl.likedCnt, COUNT(c.pidx) commentsCnt, pl.title, pl.content, pl.post_image
            FROM ( SELECT u.user_image, u.name, p.title, p.content, p.post_image, p.pidx, COUNT(l.pidx) likedCnt
                FROM `post` p
                    JOIN `user` u ON p.uidx = u.uidx
                    JOIN `liked` l ON p.pidx = l.pidx
                GROUP BY l.pidx
            ) pl JOIN `comments` c ON pl.pidx = c.pidx
            GROUP BY c.pidx
        ");
        view('main', ['posts' => $posts]);
    }
    function register() {
        view('auth/register');
    }
    function login() {
        view('auth/login');
    }
    function profile($url) {
        $uidx = $url[1];
        $user = fetch("SELECT `uidx`, `id`, `name` FROM `user` WHERE uidx = ?", [$uidx]);
        $written = fetch("SELECT * FROM `post` WHERE uidx = ?", [$uidx]);
        $liked = fetch("SELECT * FROM `liked`");
        view('profile', ['user' => $user, 'written' => $written, 'liked' => $liked]);
    }
    function createPost() {
        view('createPost');
    }
    function createPostCtrl() {
        extract($_POST);
        fetch('INSERT INTO `post`(`uidx`, `title`, `content`) VALUES (?,?,?)', [ss()->uidx, $title, $content]);
        move('/');
    }
    function detailPost($data) {
        $post = fetch("SELECT * FROM post WHERE idx=?", [$data[1]]);
        view('detailPost', ['idx' => $post->idx, 'writer' => $post->writer, 'title' => $post->title, 'content' => $post->content, 'comment' => $post->comments]);
    }
    function editPost($data) {
        view('editPost', ['idx' => $data[1]]);
    }
    function editPostCtrl($data) {
        extract($_POST);
        fetch("UPDATE `post` SET `title`=?, `content`=? WHERE idx=?", [$title, $content, $data[1]]);
        move('/', '완료되었다 수정.');
    }
    function deletePost($data) {
        fetch("DELETE FROM `post` WHERE idx=?", [$data[1]]);
        move('/', '완료되었다 삭제.');
    }
    function getData($url) {
        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json; charset=UTF-8');
        $response = (object) [];
        $data = fetch("UPDATE `post` SET `likeCnt`=? WHERE idx=?", [$likeCnt+1, $url[1]]);
        $response->data = $data;
        echo json_encode($response);
    }
    function writeComment($url) {
        extract($_GET);
        move('test', ['ss' => $comment]);
        // fetch("UPDATE `post` SET `comments`=? WHERE idx=?", [$comment, $url[1]]);
        // back();
    }
}
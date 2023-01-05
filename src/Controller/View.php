<?php

namespace src\Controller;

class View {
    function main() {
        $posts = fetchAll("SELECT * FROM `post` AS p JOIN `user` AS u ON p.uidx = u.uidx ORDER BY pidx DESC");
        view('main', ['posts' => $posts]);
    }
    function register() {
        view('auth/register');
    }
    function login() {
        view('auth/login');
    }
    function profile($data) {
        $user = fetch("SELECT * FROM `user` WHERE name = ?", [$data[1]]);
        $post = fetchAll("SELECT * FROM `post` WHERE writer = ?", [$data[1]]);
        view('profile', ['id' => $user->id, 'name' => $user->name, 'post' => $post]);
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
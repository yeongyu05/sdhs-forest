<?php

namespace src\Controller;

class View {
    function main() {
        $posts = fetchAll("
            SELECT u.name, count(l.pidx) AS likeCnt, count(c.comment) AS commentCnt, p.title, p.content
            FROM `post` AS p
            JOIN `user` AS u
            ON p.uidx = u.uidx
            JOIN `like` AS l
            ON p.pidx = l.pidx
            JOIN `comments` AS c
            ON p.pidx = c.pidx
            GROUP BY p.pidx
            ORDER BY p.pidx DESC
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
        // - 프로필 
        //     - `프로필 이미지`
        //     - `유저 아이디` : (#,@) ID
        //     - `유저 이름`
        // - 본인의 프로필 페이지 일 떄 **게시글 생성 버튼** 존재
        // - TABS 
        //     - TAB : 작성한 글 보기 
        //     - TAB : 좋아요한 글 보기
        // - 게시글은 메인페이지의 게시글과 설정 동일
        $uidx = $url[1];
        $user = fetch("SELECT `uidx`, `id`, `name` FROM `user` WHERE uidx = ?", [$uidx]);
        $written = fetch("SELECT * FROM `post` WHERE uidx = ?", [$uidx]);
        $liked = fetch("
            SELECT `u.uidx`, `p.title`, `p.content`
            FROM `like` AS l
            JOIN `post` AS p
            ON l.pidx = p.pidx
            WHERE l.uidx = 1
        ");
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
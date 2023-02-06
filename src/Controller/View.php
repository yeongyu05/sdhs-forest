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
        $target_dir = "uploaded-images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "$File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if(file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" &&
            $imageFileType != "png" &&
            $imageFileType != "jpeg" &&
            $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
                $postImage = $_FILES["fileToUpload"]["name"];
                $post = query("INSERT INTO `post`(`uidx`, `title`, `content`, `post_image`) VALUES (?,?,?,?)", [ss()->uidx, $title, $content, $postImage]);
                if($post) {
                    move("/", "작성완료");
                }
                back('안돼요.');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    function detailPost($url) {
        if(!ss()) move('/login', '로그인을 원합니다.');
        $pidx = $url[1];
        $post = fetch("SELECT * FROM post WHERE pidx = ?", [$pidx]);
        $comments = fetchAll("SELECT * FROM `comments` WHERE pidx = ? ORDER BY groupNum, depth", [$pidx]);
        $date = date('Y-m-d');
        $isVisited = fetch("SELECT * FROM `visitors` WHERE pidx = ? AND uidx = ? AND date = ?", [$pidx, ss()->uidx, $date]);
        !$isVisited && query("INSERT INTO `visitors`(`pidx`, `uidx`, `date`) VALUES (?,?,?)", [$pidx, ss()->uidx, $date]);
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
        if($commentInput) {
            fetch("INSERT INTO `comments`(`pidx`, `uidx`, `comment`, `depth`, `groupNum`) VALUES (?,?,?,?,?)", [$pidx, ss()->uidx, $commentInput, 0, 0]);
            query("UPDATE `comments` SET `groupNum`=? WHERE cidx=?", [lastInsertId(), lastInsertId()]);
            back();
        } else if($nestedCommentInput) {
            fetch("INSERT INTO `comments`(`pidx`, `uidx`, `comment`, `depth`, `groupNum`) VALUES (?,?,?,?,?)", [$pidx, ss()->uidx, $nestedCommentInput, 1, $cidx]);
            back();
        }
    }
    function liked($url) {
        $pidx = $url[1];
        $uidx = ss()->uidx;
        $isLiked = fetch("SELECT * FROM `liked` WHERE pidx = ? AND uidx = ?", [$pidx, $uidx]);
        if($isLiked) {
            fetch("DELETE FROM `liked` WHERE pidx = ? AND uidx = ?", [$pidx, $uidx]);
            back();
        }
        fetch("INSERT INTO `liked`(`pidx`, `uidx`) VALUES (?,?)", [$pidx, $uidx]);
        back();
    }
    function postStatistics($url) {
        $pidx = $url[1];
        $today = date('Y-m-d');
        $total = fetch("SELECT *, count(pidx) cnt FROM `visitors` WHERE pidx = ? GROUP BY pidx", [$pidx]);
        $daily = fetch("SELECT *, count(pidx) cnt FROM `visitors` WHERE pidx = ? AND date = ? GROUP BY pidx", [$pidx, $today]);
        $visitors = fetchAll("SELECT * FROM `visitors` WHERE pidx = ?", [$pidx]);
        view('postStatistics',['total' => $total, 'daily' => $daily, 'visitors' => $visitors]);
    }
    function userStatistics() {
        $list = fetchAll("
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
        ");
        view('userStatistics', ['list' => $list]);
    }
}
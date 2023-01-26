<?php

namespace src\Controller;

class User {
    function register() {
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
                $userImage = $_FILES["fileToUpload"]["name"];
                $user = query("INSERT INTO `user` SET id=?, password=?, name=?, user_image=?", [$id, $password, $name, $userImage]);
                if($user) {
                    move("/login", "회원가입 성공");
                }
                back('중복되는 id 입니다.');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function login() {
        extract($_POST);
        $data = fetch("SELECT * FROM user WHERE id=? AND password=?", [$id, $password]);
        if(!$data) {
            move("/login", '틀렸다 아이디 또는 비밀번호');
        }
        $_SESSION['user'] = $data;
        move("/", "로그인 완료");
    }
    function logout() {
        unset($_SESSION['user']);
        move("/", "되었다 로그아웃.");
    }
}
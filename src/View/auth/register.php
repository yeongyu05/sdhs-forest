<main id="register">
    <div class="inner">
        <h1>회원가입</h1>
        <form action="/register" method="post" enctype="multipart/form-data" class="flex">
            <div><input type="text" name="id" placeholder="아이디" required></div>
            <div><input type="password" name="password" placeholder="비밀번호" required></div>
            <div><input type="text" name="name" placeholder="이름" required></div>
            <div>프로필 사진</div>
            <div><input type="file" name="fileToUpload"></div>
            <button type="submit">회원가입</button>
        </form>
    </div>
</main>
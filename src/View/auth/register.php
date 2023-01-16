<main>
    <form action="/register" method="post" enctype="multipart/form-data">
        <h1>회원가입</h1>
        <p><input type="text" name="id" placeholder="아이디" required></p>
        <p><input type="password" name="password" placeholder="비밀번호" required></p>
        <p><input type="text" name="name" placeholder="이름" required></p>
        <p>프로필 사진</p>
        <p><input type="file" name="image"></p>
        <button type="submit">회원가입</button>
    </form>
</main>
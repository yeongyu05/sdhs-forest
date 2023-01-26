<main>
    <h1>게시글 생성 페이지</h1>
    <form action="/createPost" method="post" enctype="multipart/form-data">
        <p><input type="text" name="title" placeholder="게시글 제목" required></p>
        <p><textarea name="content" placeholder="게시글 내용" rows="5" cols="30" required></textarea></p>
        <p>게시글 이미지 등록 <input type="file" name="fileToUpload"></p>
        <button type="submit">게시글 등록</button>
    </form>
</main>
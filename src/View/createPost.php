<main id="createPost">
    <div class="inner">
        <h1>게시글 생성 페이지</h1>
        <form action="/createPost" method="post" enctype="multipart/form-data">
            <p><input type="text" name="title" placeholder="게시글 제목" required></p>
            <p><textarea name="content" placeholder="게시글 내용" rows="5" cols="30" required></textarea></p>
            <p>게시글 이미지 등록</p>
            <p><input type="file" name="fileToUpload"></p>
            <p></p><button type="submit">작성완료</button>
        </form>
    </div>
</main>
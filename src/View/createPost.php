<main id="createPost">
    <div class="inner">
        <h1>게시글 생성 페이지</h1>
        <form action="/createPost" method="post" enctype="multipart/form-data" class="flex">
            <div><input type="text" name="title" placeholder="게시글 제목" required></div>
            <div><textarea name="content" placeholder="게시글 내용" required></textarea></div>
            <div>게시글 이미지 등록</div>
            <div><input type="file" name="fileToUpload"></div>
            <button type="submit">작성완료</button>
        </form>
    </div>
</main>
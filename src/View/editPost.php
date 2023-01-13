<main>
    <form action="/editPost/<?= $post->pidx?>" method="post">
        <p><input type="text" name="title" placeholder="게시글 제목" value="<?= $post->title?>"></p>
        <p><textarea name="content" placeholder="게시글 내용" rows="5" cols="30"><?= $post->content?></textarea></p>
        <button type="submit">게시글 수정</button>
    </form>
</main>
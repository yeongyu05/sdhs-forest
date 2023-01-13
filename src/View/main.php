<main id="main">
    <h1>메인 페이지</h1>
    <div>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    </div>
    <?php foreach($posts as $post): ?>
        <div onclick="location.href = '/detailPost/<?= $post->pidx?>'">
            <span>프로필 사진<?= $post->user_image?></span>
            <span><?= $post->name?></span>
            <button type="button" onclick="location.href='/liked/<?= $post->pidx?>'">좋아요</button>
            <span>좋아요 <?= $post->likedCnt?>개</span>
            <span>댓글 <?= $post->commentsCnt?>개</span>
            <span><?= $post->title?></span>
            <span><?= $post->content?></span>
            <span>게시글 사진<?= $post->post_image?></span>
        </div>
    <?php endforeach; ?>
</main>
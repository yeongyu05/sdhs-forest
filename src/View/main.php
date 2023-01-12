<main id="main">
    <h1>메인 페이지</h1>
    <div>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    </div>
    <?php foreach($posts as $item): ?>
        <div onclick="location.href = '/detailPost/<?= $item->pidx?>'">
            <span>프로필 사진<?= $item->user_image?></span>
            <span><?= $item->name?></span>
            <button type="button">좋아요</button>
            <span>좋아요 <?= $item->likedCnt?>개</span>
            <span>댓글 <?= $item->commentsCnt?>개</span>
            <span><?= $item->title?></span>
            <span><?= $item->content?></span>
            <span>게시글 사진<?= $item->post_image?></span>
        </div>
    <?php endforeach; ?>
</main>
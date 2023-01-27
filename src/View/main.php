<main id="main">
    <h1>메인 페이지</h1>
    <div>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    </div>
    <?php foreach($posts as $post): ?>
        <div class="post" data-pidx="<?= $post->pidx?>">
            <?php if($post->user_image): ?>
            <span><img src="/uploaded-images/<?= $post->user_image?>" alt="userImg"></span>
            <?php endif;?>
            <span><?= $post->name?></span>
            <?php if(ss()):?>
            <button type="button" class="likeBtn">좋아요</button>
            <?php endif;?>
            <span>좋아요 <?= $post->likedCnt?>개</span>
            <span>댓글 <?= $post->commentsCnt?>개</span>
            <span><?= $post->title?></span>
            <span><?= $post->content?></span>
            <?php if($post->post_image): ?>
            <span><img src="/uploaded-images/<?= $post->post_image?>" alt="postImg"></span>
            <?php endif;?>
        </div>
    <?php endforeach; ?>
</main>
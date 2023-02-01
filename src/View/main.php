<main id="main">
    <div class="inner">
        <h1>메인 페이지</h1>
        <div class="container grid">
            <?php foreach($posts as $post): ?>
                <div class="post" data-pidx="<?= $post->pidx?>">
                    <?php if($post->post_image): ?>
                    <div><img src="/uploaded-images/<?= $post->post_image?>" alt="postImg"></div>
                    <?php else:?>
                    <div></div>
                    <?php endif;?>
                    <div class="flex">
                        <?php if($post->user_image): ?>
                        <div><img src="/uploaded-images/<?= $post->user_image?>" alt="userImg"></div>
                        <?php endif;?>
                        <div><?= $post->name?></div>
                        <div><?= $post->title?></div>
                        <div><?= $post->content?></div>
                    </div>
                    <div class="flex">
                        <div>댓글 <?= $post->commentsCnt?>개</div>
                        <div>좋아요 <?= $post->likedCnt?>개</div>
                        <?php if(ss()):?>
                        <div><button type="button" class="likeBtn">좋아요</button></div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
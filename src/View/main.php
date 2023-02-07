<main id="main">
    <div class="inner">
        <h1>메인 페이지</h1>
        <div class="container">
            <div class="columnName flex">
                <div>유저 프로필 사진</div>
                <div>유저 이름</div>
                <div>좋아요 버튼</div>
                <div>좋아요 총 갯수</div>
                <div>댓글 총 갯수</div>
                <div>게시글 제목</div>
                <div>게시글 내용</div>
                <div>게시글 사진</div>
            </div>
            <?php foreach($posts as $post): ?>
                <div class="post flex" data-pidx="<?= $post->pidx?>">
                    <div>
                        <?php if($post->user_image): ?>
                        <img src="/uploaded-images/<?= $post->user_image?>" alt="userImg">
                        <?php endif;?>
                    </div>
                    <div><?= $post->name?></div>
                    <?php if(ss()):?>
                    <div>
                        <button type="button" class="likeBtn">좋아요</button>
                    </div>
                    <?php endif;?>
                    <div><?= $post->likedCnt?>개</div>
                    <div><?= $post->commentsCnt?>개</div>
                    <div><?= $post->title?></div>
                    <div><?= $post->content?></div>
                    <div>
                        <?php if($post->post_image): ?>
                        <img src="/uploaded-images/<?= $post->post_image?>" alt="postImg">
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
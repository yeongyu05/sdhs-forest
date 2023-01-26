<main id="profile">
    <h1>프로필 페이지</h1>
    <div>
        <?php if($user->user_image): ?>
        <img src="/uploaded-images/<?=$user->user_image ?>">
        <?php endif;?>
    </div>
    <div>아이디: <?=$user->id ?></div>
    <div>이름: <?=$user->name ?></div>
    <?php if(ss() && ss()->uidx == $user->uidx):?>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    <?php endif;?>
    <h3>작성한 글</h3>
    <?php foreach($written as $post): ?>
        <div class="post" data-pidx="<?= $post->pidx?>">
            <?php if($user->user_image): ?>
            <span><img src="/uploaded-images/<?= $post->user_image?>" alt="<?= $post->user_image?>"></span>
            <?php endif;?>
            <span><?= $post->name?></span>
            <?php if(ss()):?>
            <button type="button" class="likeBtn">좋아요</button>
            <?php endif;?>
            <span>좋아요 <?= $post->likedCnt?>개</span>
            <span>댓글 <?= $post->commentsCnt?>개</span>
            <span><?= $post->title?></span>
            <span><?= $post->content?></span>
            <span>게시글 사진<?= $post->post_image?></span>
        </div>
    <?php endforeach; ?>
    <h3>좋아요한 글</h3>
    <?php foreach($liked as $post): ?>
        <div class="post" data-pidx="<?= $post->pidx?>">
            <?php if($user->user_image): ?>
            <span><img src="/uploaded-images/<?= $post->user_image?>" alt="<?= $post->user_image?>"></span>
            <?php endif;?>
            <span><?= $post->name?></span>
            <?php if(ss()):?>
            <button type="button" class="likeBtn">좋아요</button>
            <?php endif;?>
            <span>좋아요 <?= $post->likedCnt?>개</span>
            <span>댓글 <?= $post->commentsCnt?>개</span>
            <span><?= $post->title?></span>
            <span><?= $post->content?></span>
            <span>게시글 사진<?= $post->post_image?></span>
        </div>
    <?php endforeach; ?>
</main>
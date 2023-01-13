<main>
    <h1>프로필 페이지</h1>
    <div>프로필 사진: <?=$user->user_image ?></div>
    <div>아이디: <?=$user->id ?></div>
    <div>이름: <?=$user->name ?></div>
    <?php if(ss() && ss()->uidx == $user->uidx):?>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    <?php endif;?>
    <h3>작성한 글</h3>
    <?php foreach($written as $post):?>
        <div>
            <?= $post->user_image?>
            <?= $post->name?>
            <button type="button">좋아요</button>
            <?= $post->likedCnt?>
            <?= $post->commentsCnt?>
            <?= $post->title?>
            <?= $post->content?>
            <?= $post->post_image?>
        </div>
    <?php endforeach;?>
    <h3>좋아요한 글</h3>
    <?php foreach($liked as $post):?>
        <div>
            <?= $post->user_image?>
            <?= $post->name?>
            <button type="button">좋아요</button>
            <?= $post->likedCnt?>
            <?= $post->commentsCnt?>
            <?= $post->title?>
            <?= $post->content?>
            <?= $post->post_image?>
        </div>
    <?php endforeach;?>
</main>
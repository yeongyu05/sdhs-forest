<main id="userStatistics">
    <h2>유저 통계 리스트</h2>
    <?php foreach($list as $item):?>
        <div>
            <span><?=$item->id ?></span>
            <span><?=$item->name ?></span>
            <?php if($item->user_image):?>
                <span><img src="/uploaded-images/<?=$item->user_image ?>" alt="user_image"></span>
            <?php endif;?>
            <span>총 게시글 수: <?=$item->post ?></span>
            <span>총 게시글 좋아요 수: <?=$item->liked ?></span>
            <span>총 게시글 댓글 수: <?=$item->comments ?></span>
        </div>
    <?php endforeach;?>
</main>
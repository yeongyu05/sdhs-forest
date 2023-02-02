<main id="detailPost">
    <div><?= $post->title?></div>
    <div><?= $post->content?></div>
    <?php if($post->post_image): ?>
    <div><img src="/uploaded-images/<?= $post->post_image?>" alt="<?= $post->post_image?>"></div>
    <?php endif;?>
    <?php if(ss() && $post->uidx == ss()->uidx):?>
        <div>
            <button type="button" class="editBtn" onclick="location.href = '/editPost/<?= $post->pidx?>'">수정</button>
            <button type="button" class="deleteBtn" onclick="location.href ='/deletePost/<?= $post->pidx?>'">삭제</button>
            <button type="button" class="Btn" onclick="location.href ='/postStatistics/<?= $post->pidx?>'">통계 페이지</button>
        </div>
    <?php endif;?>
    <div>댓글</div>
    <form action="/writeComment/<?= $post->pidx?>" method="post">
        <input type="text" name="commentInput">
        <div class="comments">
            <?php foreach($comments as $item):?>
                <div class="comment" data-cidx="<?=$item->cidx ?>">
                    <?php if($item->depth == 0):?>
                        <div>댓글: <?=$item->comment ?></div>
                    <?php elseif($item->depth == 1):?>
                        <div class="nestedC">대댓글: <?=$item->comment ?></div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </form>
</main>
<main id="detailPost">
    <?= $post->title?>
    <?= $post->content?>
    <?= $post->post_image?>
    <?php if(ss() && $post->uidx == ss()->uidx):?>
        <div>
            <button type="button" class="editBtn" onclick="location.href = '/editPost/<?= $post->pidx?>'">수정</button>
            <button type="button" class="deleteBtn" onclick="location.href ='/deletePost/<?= $post->pidx?>'">삭제</button>
            <button type="button" class="Btn">통계 페이지</button>
        </div>
    <?php endif;?>
    <div>댓글</div>
    <form action="/writeComment/<?= $post->pidx?>" method="post">
        <input type="text" name="comment" required>
        <button type="submit">작성</button>
        <div class="comments">
            <?php foreach($comments as $item):?>
                <div><?= $item->comment?></div>
            <?php endforeach;?>
        </div>
    </form>
</main>
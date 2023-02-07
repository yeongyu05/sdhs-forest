<main id="userStatistics">
    <div class="inner">
        <h2>유저 통계 리스트</h2>
        <div class="container">
            <div class="columnName flex">
                <div>유저 아이디</div>
                <div>유저 이름</div>
                <div>유저 프로필 사진</div>
                <div>총 게시글 수</div>
                <div>총 게시글 좋아요 수</div>
                <div>총 게시글 댓글 수</div>
            </div>
            <?php foreach($list as $item):?>
                <div class="item flex">
                    <div><?=$item->id ?></div>
                    <div><?=$item->name ?></div>
                    <div>
                        <?php if($item->user_image):?>
                        <img src="/uploaded-images/<?=$item->user_image ?>" alt="user_image">
                        <?php endif;?>
                    </div>
                    <div><?=$item->post ?>개</div>
                    <div><?=$item->liked ?>개</div>
                    <div><?=$item->comments ?>개</div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</main>
<main id="profile">
    <div class="inner">
        <h1>프로필 페이지</h1>
        <div class="profileWrap flex">
            <div class="userImage">
                <?php if($user->user_image): ?>
                <img src="/uploaded-images/<?=$user->user_image ?>">
                <?php endif;?>
            </div>
            <div class="info">
                <div>아이디: <?=$user->id ?></div>
                <div>이름: <?=$user->name ?></div>
                <?php if(ss() && ss()->uidx == $user->uidx):?>
                <div>
                    <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
                </div>
                <?php endif;?>
                <div>
                    <button onclick="location.href='/userStatistics'">유저 통계 리스트</button>
                </div>
            </div>
        </div>
        <section>
            <div class="tabs flex">
                <div class="selected">작성한 글보기</div>
                <div>좋아요한 글보기</div>
            </div>
            <article>
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
                <?php foreach($written as $post): ?>
                    <div class="post flex" data-pidx="<?= $post->pidx?>">
                        <div>
                            <?php if($user->user_image): ?>
                            <img src="/uploaded-images/<?= $post->user_image?>" alt="<?= $post->user_image?>">
                            <?php endif;?>
                        </div>
                        <div><?= $post->name?></div>
                        <?php if(ss()):?>
                        <div>
                            <button type="button" class="likeBtn">좋아요</button>
                        </div>
                        <?php endif;?>
                        <div>좋아요 <?= $post->likedCnt?>개</div>
                        <div>댓글 <?= $post->commentsCnt?>개</div>
                        <div><?= $post->title?></div>
                        <div><?= $post->content?></div>
                        <div>
                            <?php if($post->post_image): ?>
                            <img src="/uploaded-images/<?= $post->post_image?>" alt="postImg">
                            <?php endif;?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>
            <article class="none">
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
                <?php foreach($liked as $post): ?>
                    <div class="post flex" data-pidx="<?= $post->pidx?>">
                        <div>
                            <?php if($user->user_image): ?>
                            <div><img src="/uploaded-images/<?= $post->user_image?>" alt="<?= $post->user_image?>"></div>
                            <?php endif;?>
                        </div>
                        <div><?= $post->name?></div>
                        <?php if(ss()):?>
                        <div>
                            <button type="button" class="likeBtn">좋아요</button>
                        </div>
                        <?php endif;?>
                        <div>좋아요 <?= $post->likedCnt?>개</div>
                        <div>댓글 <?= $post->commentsCnt?>개</div>
                        <div><?= $post->title?></div>
                        <div><?= $post->content?></div>
                        <div>
                            <?php if($post->post_image):?>
                            <img src="/uploaded-images/<?= $post->post_image?>" alt="postImg">
                            <?php endif;?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>
        </section>
    </div>
</main>
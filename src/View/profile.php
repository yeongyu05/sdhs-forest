<main>
    <h1>프로필 페이지</h1>
    <div>아이디: <?=$id ?></div>
    <div>이름: <?=$name ?></div>
    <?php if(ss()->uidx == $uidx):?>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    <?php endif;?>
    <h3>작성한 글</h3>
    <?php foreach($written as $post):?>
        <?= $post?>
    <?php endforeach;?>
    <h3>좋아요한 글</h3>
    <?php foreach($liked as $post):?>
        <?= $post?>
    <?php endforeach;?>
</main>
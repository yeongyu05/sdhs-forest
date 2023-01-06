<main id="main">
    <h1>메인 페이지</h1>
    <div>
        <button type="button" onclick="location.href = '/createPost'">게시글 생성</button>
    </div>
    <?php foreach($posts as $item): ?>
        <div onclick="location.href = '/detailPost/<?= $item->pidx?>'">
            <?= $item->name?>
            <?= $item->likeCnt?>
            <?= $item->commentCnt?>
            <?= $item->title?>
            <?= $item->content?>
        </div>
    <?php endforeach; ?>
</main>
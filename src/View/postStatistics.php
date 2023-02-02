<main id="postStatistics">
    <div>게시글 전체 방문자 수: <?=$total->cnt ?></div>
    <div>일일 방문자 수: <?=$daily->cnt ?></div>
    <div>주간 방문자 수 막대 그래프</div>
    <canvas id="canvas"></canvas>
    <script>
        const today = "<?=$today ?>";
        const weekly = <?=$weekly->cnt ?>;
        const all = <?=json_encode($all) ?>;
    </script>
</main>
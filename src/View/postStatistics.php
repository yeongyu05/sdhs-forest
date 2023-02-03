<main id="postStatistics">
    <div>게시글 전체 방문자 수: <?=$total ? $total->cnt : 0 ?></div>
    <div>일일 방문자 수: <?=$daily ? $daily->cnt : 0 ?></div>
    <div>주간 방문자 수 막대 그래프</div>
    <canvas id="canvas"></canvas>
    <script>const visitors = <?=json_encode($visitors) ?>;</script>
</main>
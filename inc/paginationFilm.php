<?php
$count = 5;
$startPage = max(1, $currentPage - $count);
$endPage = min( $nbPage, $currentPage + $count);
?>
<div>
    <ul class="pagination">
        <li class="page-item <?= $activePrev ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= "?currentPage=next," . $currentPage ?>">&laquo;</a>
        </li>
        <?php for ($i = $startPage; $i < $endPage; $i++) : ?>
            <li class="page-item <?= $i === $activePage  ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= "?currentPage=$i" ?>"><?= $i ?></a>
            </li>
        <?php endfor ?>
        <li class="page-item <?= $activeNext || $activePage == $nbPage ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= "?currentPage=next," . $currentPage ?>">&raquo;</a>
        </li>
    </ul>
</div>
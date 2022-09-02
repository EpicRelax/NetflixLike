<?php
$count = 5;
$startPage = max(1, $currentPage - $count);
$endPage = min( $nbPage, $currentPage + $count);
?>
<div>
    <ul class="pagination">
        <li class="page-item <?= $activePrev ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= "?genre=" . $_GET['genre'] . "&currentPage=prev," . $currentPage ?>">&laquo;</a>
        </li>
        <?php for ($i = $startPage; $i < $endPage; $i++) : ?>
            <li class="page-item <?= $i === $activePage  ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= "?genre=" . $_GET['genre'] . "&currentPage=$i" ?>"><?= $i ?></a>
            </li>
        <?php endfor ?>
        <li class="page-item <?= $activeNext || $activePage == $nbPage ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= "?genre=" . $_GET['genre'] . "&currentPage=next," . $currentPage ?>">&raquo;</a>
        </li>
    </ul>
</div>
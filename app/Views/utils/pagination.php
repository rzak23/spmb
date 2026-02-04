<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(2);
?>
<ul class="pagination pagination-sm m-0 float-right">
    <?php if($pager->hasPrevious()): ?>
    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
    <?php endif ?>

    <?php foreach($pager->links() as $link): ?>
    <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
    </li>
    <?php endforeach ?>

    <?php if($pager->hasNext()): ?>
    <li class="page-item"><a cla}ss="page-link" href="#">&raquo;</a></li>
    <?php endif ?>
</ul>
<?php if ($pager->getPageCount() > 1) : ?>
<nav>
    <ul class="pagination justify-content-center">
        <!-- Bouton Première page -->
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Première">
                <span aria-hidden="true">&laquo;&laquo;</span>
            </a>
        </li>

        <!-- Bouton Page précédente -->
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Précédente">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <!-- Liens vers chaque page -->
        <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active bg-dark text-light border-dark' : '' ?>">
            <a class="page-link <?= $link['active'] ? 'bg-dark text-light border-dark' : '' ?>" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?> <!--lien vers la page-->
            </a>
        </li>

        <?php endforeach; ?>

        <!-- Bouton Page suivante -->
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Suivante">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

        <!-- Bouton Dernière page -->
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Dernière">
                <span aria-hidden="true">&raquo;&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>
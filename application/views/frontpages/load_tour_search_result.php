<?php
if ($tours) {
    $transfer_tour_type = array(9, 10);
?>
    <div class="search-list-wrapper">
        <ul>
            <?php
            foreach ($tours  as $tour) {
            ?>
                <li>
                    <a href="<?= BASE_URL . ((in_array($tour['tour_type_id'], $transfer_tour_type)) ? 'transfer/' : 'tours/') . $tour['slug'] ?>"><?= $tour['title'] ?></a>
                </li>
            <?php
            }
            if ($total_tours > 5) {
            ?>
                <li class="viewmore-btn">
                    <a href="<?= BASE_URL . 'search-tour/' . $tour_name ?>">View All</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
<?php
} else {
?>
    <div class="search-list-wrapper">
        <ul>
            <li class="not-tour-found">No tour found!</li>
        </ul>
    </div>
<?php
}
?>
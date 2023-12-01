<?php
require_once LIBRARY . '/util/util.php';

$query = "SELECT * FROM cakes";
$cakesData = fetchAll($query);

require_once COMPONENTS . '/cake-card.php';

echo '<div class="flex flex-row gap-4 md:gap-0">';

foreach ($cakesData as $cake) {
    echo '
    <div class="flex gap-4">
        <div class="flex md:flex-row justify-between gap-8">
    ';

    // Use $cake data to render the cake card
    require_once COMPONENTS . '/cake-card.php'; 
    cakeCard($cake, true);

    echo '
        </div>
    </div>
    ';
}

echo '</div>';
?>

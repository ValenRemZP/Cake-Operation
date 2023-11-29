<?php
require_once LIBRARY . '/util/util.php';


$query = "SELECT cakes.*, cakecategories.name AS category_name FROM cakes
          JOIN cakecategories ON cakes.category_id = cakecategories.id";

$cakesData = fetchAll($query);

require_once LIBRARY . '/catalog/cakes.php';
require_once COMPONENTS . '/cake-card.php';

echo '
<div class="flex flex-col gap-12 md:gap-24">
';

foreach ($cakesData as $cake) {
    $categoryName = $cake['category_name'];

    echo '
    <div class="flex flex-col gap-4">
        <p class="text-3xl font-bold">' .
        $categoryName .
        '</p>
        <div class="w-full flex flex-col md:flex-row flex-wrap justify-between gap-8">
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

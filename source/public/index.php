<?php
require_once LIBRARY . '/catalog/cakes.php';
require_once COMPONENTS . '/cake-card.php';

echo '<div class="flex flex-col gap-12 md:gap-24">';

foreach ($categories as $categoryName => $cakes) {
    echo '<div class="flex flex-col gap-4">
            <p class="text-3xl font-bold">' . $categoryName . '</p>
            <div class="w-full flex flex-col md:flex-row flex-wrap justify-between gap-8">';

    foreach ($cakes as $cake) {
        productCard($cake);
    }

    echo '</div>
        </div>';
}

echo '</div>';
?>

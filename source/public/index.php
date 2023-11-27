<?php
require_once LIBRARY . '/catalog/cakes.php';
require_once COMPONENTS . '/cake-card.php';

echo '
<div class="flex flex-col gap-12 md:gap-24">
';

$i = 0;
foreach ($categories as $category) {
  $categoryName = array_keys($categories)[$i];

  echo '
  <div class="flex flex-col gap-4">
    <p class="text-3xl font-bold">' .
    $categoryName .
    '</p>
    <div class="w-full flex flex-col md:flex-row flex-wrap justify-between gap-8">
  ';

  foreach ($category as $cake) {
    cakeCard($cake);
  }

  echo '
    </div>
  </div>
  ';

  $i++;
}

echo '</div>';
?>

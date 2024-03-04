<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';
require_once LIBRARY . '/util/util.php';

$query =
  'SELECT * FROM cakes JOIN favorites ON (cakes.id = favorites.cakeid) WHERE favorites.userid = ?';
$favorites = fetchSingle($query, [
  'type' => 'i',
  'value' => $_SESSION['user']['id'],
]);

echo '<div class="flex flex-col gap-8">';
foreach ($favorites as $favorite) {
  echo '
		<div class="card card-side bg-base-100 shadow-sm max-h-48">
      <figure class="max-w-sm">
        <img src="/public/pics/' .
    $favorite['imageUrl'] .
    '" alt="Pic"/>
      </figure>
      <div class="card-body">
        <h2 class="card-title">' .
    $favorite['name'] .
    '</h2>
        <p>' .
    $favorite['description'] .
    '</p>
        <div class="card-actions justify-between items-center">
        	<p class="text-xl text-left font-bold">€' .
    $favorite['price'] .
    '</p>
          <div class="flex flex-row gap-2">
          	<a href="/catalog/cake?id=' .
    $favorite['cakeid'] .
    '" class="btn btn-primary">View cake card</a>
            <form method="post" action="/source/lib/catalog/delete-fav.php">
            	<input type="hidden" name="cake_id" value="' .
    $favorite['cakeid'] .
    '">
              <button class="btn btn-error btn-square" name="delete">
              	<i class="fa-regular fa-trash-can fa-xl text-white"></i>
              </button>
						</form>
          </div>
        </div>
      </div>
    </div>';
}
echo '</div>';


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

$cakeId = $_GET['id'];
$query = 'SELECT * FROM cakes WHERE id = ?';
$cakeData = fetch($query, ['type' => 'i', 'value' => $cakeId]);
?>

<div class="w-full flex justify-center md:justify-start text-xl breadcrumbs text-rose-500">
  <ul>
    <li><a href="/">Home</a></li>
    <li>Catalog</li>
    <li><a href="/catalog/cakes">All cakes</a></li>
  </ul>
</div>
<div class="flex flex-col md:flex-row gap-4">
  <div class="flex-[1.3]">
    <img class="w-full h-full aspect-[3/2] rounded-2xl object-cover" src="<?php echo $cakeData["imageUrl"] ?>" alt="">
  </div>
  <div id="actions" class="flex flex-[.7] bg-base-100 rounded-2xl p-8 flex-col items-center justify-center">
    <div class="flex flex-row justify-center gap-8 md:gap-24 pb-8">
      <div class="flex flex-col items-center">
        <div class="flex justify-center text-center gap-4 mt-4">
          <div class="flex flex-col md:flex-[1.3] gap-4">
            <h1 class="text-2xl font-semibold text-rose-400">
              <?php echo $cakeData['name']; ?>
            </h1>
            <p class="text-xl text-rose-400">
              <?php echo $cakeData['description']; ?>
            </p>
            <br>
          </div>
        
        </div>

        <p class="font-semibold text-xl text-rose-300"> €<?= $cakeData["price"] ?></p>
        <div class="flex-[.7] p-8">
            <!-- Add the "Buy Now" button here -->
            <form method="post" action="/checkout.php">
              <input type="hidden" name="cake_id" value="<?= $cakeData['id'] ?>">
              <input type="hidden" name="cake_name" value="<?= $cakeData['name'] ?>">
              <input type="hidden" name="cake_price" value="<?= $cakeData['price'] ?>">
              <button type="submit" name="buy_now" class="btn bg-rose-400 text-white  px-4 py-2 rounded">Buy Now</button>
            </form>
          </div>
      </div>
    </div>
    <br>
  </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';


$cakeId = 1;
$query = 'SELECT * FROM cakes WHERE id = ?';
$cakeData = fetch($query, ['type' => 'i', 'value' => $cakeId]);


?>


<div class="w-full flex justify-center md:justify-start text-sm breadcrumbs">
  <ul>
    <li><a href="/">Home</a></li>
    <li>Catalog</li>
    <li><a href="/catalog/cakes">Cakes</a></li>
  </ul>
</div>
<div class="flex flex-col md:flex-row gap-4">
  <div class="flex-[1.3]">
    <img class="w-full h-full aspect-[3/2] rounded-2xl object-cover" src=" <?php echo $cakeData["imageUrl"]  ?>" alt="">
  </div>
  <div id="actions" class="flex flex-[.7] bg-base-100 rounded-2xl p-8 flex-col items-center justify-center">
    <div class="flex flex-row justify-center gap-8 md:gap-24 pb-8">
      <div class="flex flex-col items-center">
      <div class="flex justify-center gap-4 mt-4">
  <div class="flex flex-col md:flex-[1.3] gap-4">
    <h1 class="text-2xl font-semibold">
      <?php echo $cakeData['name']; ?>
    </h1>
    <p>
      <?php echo $cakeData['description']; ?>
    </p>
    <br>
  </div>
  <div class="flex-[.7] p-8"></div>
</div>

        <p class="font-semibold text-xl"> €
          <?= $cakeData["price"] ?>
        </p>
      </div>
    </div>

    <br>


  </div>
</div>




<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/catalog/cakes.php';
require_once COMPONENTS . '/cake-card.php';

$cakes = []; // Initialize an empty array to store the products
$categoryname = $_GET['category'] ?? null; // Get the value of the 'category' parameter from the URL query string, if it exists

if ($categoryname) {
  // If a category name is provided, fetch the category ID from the database based on the name
  $categoryId = fetchSingle('SELECT * FROM cakecategories WHERE name = ?', ['type' => 's', 'value' => $categoryname])[0]['id'];
  // Fetch the minimum price of products in the specified category
  $minPrice = fetchSingle('SELECT MIN(price) FROM cakes WHERE category_id = ?', ['type' => 'i', 'value' => $categoryId])[0]['MIN(price)'];
} else {
  // If no category name is provided, fetch the minimum price of all products
  $minPrice = fetchSingle('SELECT MIN(price) FROM cakes')[0]['MIN(price)'];
}

if ($categoryname) {
  // If a category name is provided, fetch the category ID from the database based on the name
  $categoryId = fetchSingle('SELECT * FROM cakecategories WHERE name = ?', ['type' => 's', 'value' => $categoryname])[0]['id'];
  // Fetch the maximum price of products in the specified category
  $maxPrice = fetchSingle('SELECT MAX(price) FROM cakes WHERE category_id = ?', ['type' => 'i', 'value' => $categoryId])[0]['MAX(price)'];
} else {
  // If no category name is provided, fetch the maximum price of all products
  $maxPrice = fetchSingle('SELECT MAX(price) FROM cakes')[0]['MAX(price)'];
}

if (isset($_GET['search'])) {
  // If the 'search' parameter is set in the URL query string
  $searchTerm = $_GET['search'];
  // Construct a query to search for products based on the provided search term
  $query = "SELECT * FROM cakes WHERE MATCH(name, description) AGAINST(? IN BOOLEAN MODE)";
  // Fetch the products matching the search term
  $cakes = fetchSingle($query, ['type' => 's', 'value' => "$searchTerm*"]);

} else if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
  // If both 'minPrice' and 'maxPrice' parameters are set in the URL query string
  // Construct a query to fetch products within the specified price range
  $query = "SELECT * FROM cakes WHERE price BETWEEN ? AND ?";
  // Fetch the products within the specified price range
  $cakes = fetchSingle($query, ['type' => 'i', 'value' => $_GET['minPrice']], ['type' => 'i', 'value' => $_GET['maxPrice']]);
} else if ($categoryname) {
  // If a category name is provided
  // Fetch the category ID from the database based on the name
  $categoryId = fetchSingle('SELECT * FROM cakecategories WHERE name = ?', ['type' => 's', 'value' => $categoryname])[0]['id'];
  // Fetch the products belonging to the specified category
  $cakes = fetchSingle('SELECT * FROM cakes WHERE category_id = ?', ['type' => 'i', 'value' => $categoryId]);
} else {
  // If no specific search or filter criteria are provided
  // Fetch all products
  $cakes = getAllCakes();
}

echo '
<div class="w-full flex flex-col md:flex-row gap-4 p-8 md:pr-40">
  <div class="hidden md:block md:flex-[.4] h-fit bg-base-300 py-8 md:ml-auto rounded-2xl">
    <div>
      <form method="get" class="flex flex-col px-4 gap-8">
        <div class="flex flex-col gap-4">
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span id="priceMinLabel" class="label-text text-rose-500">€' . $minPrice . '</span>
            </label>
            <div class="form-control w-full max-w-xs">  
              <input id="priceMin" name="minPrice" type="range" min="' . $minPrice . '" max="' . $maxPrice . '" value="' . $minPrice . '" class="range bg-rose-300" />
            </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span id="priceMaxLabel" class="label-text text-rose-500">€' . $maxPrice . '</span>
            </label>
            </div>
            <div class="form-control w-full max-w-xs">
              <input id="priceMax" name="maxPrice" type="range" min="0" max="' . $maxPrice . '" value="' . $maxPrice . '" class="range bg-rose-300" />
            </div>
          </div>
        </div>

        <button class="btn bg-rose-400 text-white">Filter</button>
      </form>
    </div>
  </div>
  ';

  echo '
  <div class="hidden md:flex divider divider-horizontal"></div> 

  <div class="flex flex-row flex-wrap gap-8 flex-[1.6]">
    <div class="w-full flex text-sm breadcrumbs text-xl text-rose-500">
      <ul>
        <li><a href="/">Home</a></li> 
        <li>Catalog</li>
        <li><a href="/catalog/cakes">All cakes</a></li>
      </ul>
    </div>
    
    <div class="flex flex-wrap justify-between gap-8">
';

// Loop through each product in the $cakes array
foreach ($cakes as $index => $cake) {
  // Check if the index is greater than 0 and is divisible by 4
  if ($index > 0 && $index % 4 === 0) {
    // If true, close the current row and start a new row for the next set of products
    echo '
      </div>
      <div class="flex flex-col md:flex-row flex-wrap justify-between gap-8">
    ';
  }

  // Call the productCard function and pass the current product as an argument
cakeCard($cake, true);
  
}

echo '
  </div>
</div>
';
?>

<script defer>
  // Get the range input elements
  const rangeOne = document.getElementById('priceMin');
  const rangeTwo = document.getElementById('priceMax');

  // Get the range label elements
  const rangeOneLabel = document.getElementById('priceMinLabel');
  const rangeTwoLabel = document.getElementById('priceMaxLabel');

  /**
   * Add event listener to the first range input
   *
   * @param {Event} e - The event object
   * @returns {void}
   */
  rangeOne.addEventListener('input', (e) => {
    // Update the label text with the selected value
    rangeOneLabel.textContent = `€${e.target.value}`;
  });

  /**
   * Add event listener to the second range input
   *
   * @param {Event} e - The event object
   * @returns {void}
   */
  rangeTwo.addEventListener('input', (e) => {
    // Update the label text with the selected value
    rangeTwoLabel.textContent = `€${e.target.value}`;
  });
</script>

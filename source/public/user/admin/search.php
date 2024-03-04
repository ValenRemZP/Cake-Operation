<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/catalog/cakes.php';

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $query = "SELECT * FROM cakes WHERE MATCH(name, description) AGAINST(? IN BOOLEAN MODE)";
    $cakes = fetchSingle($query, ['type' => 's', 'value' => "$searchTerm*"]);
    if ($cakes) {
        foreach ($cakes as $cake) {
            echo '
            <div class="card card-side bg-base-100 shadow-sm max-h-48">
                <figure class="max-w-sm">
                    <img src="/public/pics/' . $cake['imageUrl'] . '" alt="Movie"/>
                </figure>
                <div class="card-body">
                    <h2 class="card-title">' . $cake['name'] . '</h2>
                    <p>' . $cake['description'] . '</p>
                    <div class="card-actions justify-between items-center">
                        <p class="text-xl text-left font-bold">€' . $cake["price"] . '</p>
                        <div class="flex flex-row gap-2">
                            <a href="/catalog/cake?id=' . $cake['id'] . '" class="btn btn-primary">See cake card.</a>
                            <form action="/source/lib/user/admin/delete-cake.php" method="post" class="flex flex-col items-center gap-4">
                                <input type="text" name="cakeid" value="' . $cake['id'] . '" hidden>          
                                <label for="cakeid" hidden>cake ID</label>
                                <button type="submit" name="deleteCake" value="' . $cake['id'] . '" class="btn btn-error">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        echo '<p>No cakes found.</p>';
    }
} else {
    echo '<p>Search term not provided.</p>';
}
?>

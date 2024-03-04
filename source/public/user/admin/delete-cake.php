<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/catalog/cakes.php';

if (!isset($_SESSION['user'])) {
    header('Location: /account/login');
    exit();
}

$cakes = getAllCakes(); 
if (!$cakes) {
    echo '
    <div class="flex flex-col items-center justify-center gap-4">
        <h1 class="text-white text-2xl p-2">You have no cakes.</h1>
        <a href="/dashboard/cakes/add" class="btn bg-rose-400 text-white px-4 py-2 rounded">Add cake.</a>
    </div>
    ';
    exit();
}

echo '
<div class="flex flex-col gap-8">
';
?>
<form id="searchForm" class="flex flex-row justify-center gap-4">
    <div class="form-control w-full max-w-xs">
        <input id="searchInput" type="text" name="search" placeholder="Search" class="input input-bordered bg-white w-full">
    </div>
    <button type="submit" class="btn bg-rose-400 text-white px-4 py-2 rounded">Search</button>
</form>

<div id="cakesContainer" class="flex flex-col gap-8">
    <?php 
    foreach ($cakes as $cake) {
        echo '
        <div class="card card-side bg-base-100 shadow-sm max-h-48">
            <figure class="max-w-sm">
                <img src="/public/pics/' . $cake['imageUrl'] . '" alt="Pic"/>
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
    ?>
</div>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        var searchTerm = document.getElementById('searchInput').value.trim();
        if (searchTerm !== '') {
            fetch('search.php?search=' + searchTerm)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('cakesContainer').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIB . '/util/util.php';

$categories = fetch("SELECT * FROM cakecategories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Cake</title>
</head>
<body>
    <h1 class="text-center text-4xl font-bold mb-12">Add a new cake</h1>

    <form action="/path/to/add-cake.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4 max-w-2xl mx-auto">
        <!-- Category -->
        <div class="form-control flex-1 w-full">
            <label class="label">
                <span class="label-text">Cake category</span>
            </label>
            <select name="category" class="select select-bordered w-full">
                <?php
                foreach ($categories as $category) {
                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Name -->
        <div class="form-control flex-1 w-full">
            <label class="label">
                <span class="label-text">Cake Name</span>
            </label>
            <input type="text" name="name" placeholder="Chocolate Cake" class="input input-bordered w-full" required />
        </div>

        <!-- Description -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Description</span>
            </label>
            <textarea name="description" class="textarea textarea-bordered min-h-[8em]" placeholder="Delicious chocolate cake" required></textarea>
        </div>

        <!-- Price -->
        <div class="form-control flex-1 w-full">
            <label class="label">
                <span class="label-text tooltip" data-tip="Prices in euro">Price</span>
            </label>
            <input type="number" step="0.01" min="0.00" name="price" placeholder="20.00" class="input input-bordered w-full" required />
        </div>

        <!-- Image -->
        <div class="form-control flex-1 w-full">
            <label class="label">
                <span class="label-text">Image</span>
            </label>
            <input name="image" type="file" class="file-input file-input-bordered w-full" required />
        </div>

        <div class="form-control w-full max-w-xs mt-4">
            <button name="create" id="create" class="btn btn-primary">Create Cake</button>
        </div>
    </form>
</body>
</html>

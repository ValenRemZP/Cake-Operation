
<!-- Your HTML form for adding a cake -->
<h1 class="text-center text-4xl font-bold mb-12">Add a new cake</h1>

<form action="/source/lib/user/admin/add-cake.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4 max-w-2xl mx-auto">
    <!-- Category -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text">Cake category</span>
        </label>
        <select name="category" class="select select-bordered w-full">
            <?php
            // Fetch cake categories from the database and populate the dropdown
            $categories = fetch("SELECT * FROM cakecategories");
            foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Title -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text">Title</span>
        </label>
        <input type="text" name="title" placeholder="Cake Title" class="input input-bordered w-full" required />
    </div>

    <!-- Description -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Description</span>
        </label>
        <textarea name="description" class="textarea textarea-bordered min-h-[8em]" placeholder="Cake description" required></textarea>
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
        <button name="create" id="create" class="btn bg-rose-400">Create</button>
    </div>
</form>

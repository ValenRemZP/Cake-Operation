
<!-- Your HTML form for adding a cake -->
<h1 class="text-center text-4xl font-bold mb-12 text-rose-400">Add a new cake</h1>

<form action="/source/lib/user/admin/add-cake.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4 max-w-2xl mx-auto">
    <!-- Category -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text text-xl text-rose-400">Cake category</span>
        </label>
        <select name="category" class="select select-bordered w-full text-rose-400">
            <?php
            // Fetch cake categories from the database and populate the dropdown
            $categories = fetch("SELECT * FROM cakecategories");
            foreach ($categories as $category) {
                echo '<option class="text-xl text-rose-400" value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Title -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text text-xl text-rose-400">Title</span>
        </label>
        <input type="text" name="title" placeholder="Cake Title" class="text-xl input input-bordered w-full" required />
    </div>

    <!-- Description -->
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text text-xl text-rose-400">Description</span>
        </label>
        <textarea name="description" class="text-xl textarea textarea-bordered min-h-[8em]" placeholder="Cake description" required></textarea>
    </div>

    <!-- Price -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text tooltip text-xl text-rose-400" data-tip="Prices in euro">Price</span>
        </label>
        <input type="number" step="0.01" min="0.00" name="price" placeholder="20.00" class="text-xl input input-bordered w-full" required />
    </div>

    <!-- Image -->
    <div class="form-control flex-1 w-full">
        <label class="label">
            <span class="label-text text-xl text-rose-400">Image</span>
        </label>
        <input name="image" type="file" class="text-xl file-input file-input-bordered w-full text-rose-400" required />
    </div>

    <div class="form-control w-full max-w-xs mt-4">
        <button name="create" id="create" class="btn bg-rose-400 text-white">Create</button>
    </div>
</form>

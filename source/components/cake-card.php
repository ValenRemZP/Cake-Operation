<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';


function displayAllCakes($cakes) {
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">';
    foreach ($cakes as $cake) {
        cakeCard($cake, true);
    }
    echo '</div>';
}

function cakeCard($cake, $shareable = false) {
    $share = $shareable
        ? '<div class="dropdown dropdown-end absolute top-2 right-2">
                <label tabindex="0" class="hover:cursor-pointer">
                <i class="fa-solid fa-ellipsis-vertical fa-2xl opacity-0 group-hover:opacity-100" style="color: #ff7185;"></i>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-26 flex gap-2">
                    <button class="hover:cursor-pointer">
                        <form method="post" action="/source/lib/catalog/addfav.php">
                            <input type="hidden" name="cake_id" value="' . $cake["id"] . '">
                            <input type="hidden" name="refer" value="' . $_SERVER['REQUEST_URI'] . '">
                            <button name="favoriteIt">
                                <svg class="w-6 h-6 hover:text-black text-gray-600 inline-block mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 19">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M11 4C5.5-1.5-1.5 5.5 4 11l7 7 7-7c5.458-5.458-1.542-12.458-7-7Z" />
                                </svg>
                            </button>
                        </form>
                    </button>
                    <button name="copy"
                        onclick="createShareLink(window.location.origin + \'/cakes/share' . '?id=' . $cake["id"] . '\')">

                        <svg class="w-5 h-5 hover:text-black text-gray-600 inline-block mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m5.953 7.467 6.094-2.612m.096 8.114L5.857 9.676m.305-1.192a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0ZM17 3.84a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Zm0 10.322a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Z" />
                        </svg>

                    </button>
                </ul>
            </div>'
        : '';   

        echo '
        <a href="/catalog/cake?id=' . $cake['id'] . '">
            <div id="cake-' . $cake['id'] . '" class="group card card-compact transition hover:opacity-90 bg-base-100 shadow-xl" style="max-width: 300px;">
                <figure>
                    <img class="w-full h-48 object-cover" src="/public/pics/' . $cake['imageUrl'] . '" alt="' . $cake["name"] . '" />
                </figure>

                <div class="card-body transition relative">

                    ' . $share . '

                    <style>
a, p {
  font-family: "Brush Script MT", cursive;
}
</style>

                    <a href="/catalog/cake?id=' . $cake['id'] . '" class="card-title hover:underline text-rose-400">' . $cake["name"] . '</a>
                
                    <div class="card-actions justify-between items-center">
                        <p class="text-xl text-left font-bold text-rose-300">€' . $cake["price"] . '</p>
                
                    </div>
                </div>
            </div>
        </a>';
}
?>  
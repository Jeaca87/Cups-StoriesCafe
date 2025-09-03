<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <link rel="stylesheet" href="../../../../css/edit_menu_page.css">
    <title>Edit Menu Page</title>
</head>

<body>
    <div class="main-container">
        <?php include("../sidebar_admin.php") ?>
        <main>
            <header>
                <span class="material-symbols-rounded" img alt="toggle">menu</span>
                <div class="left">
                    <span>Manage Menu</span>
                </div>
                <div class="right">
                    <span>Admin</span>
                    <span class="material-symbols-rounded" img alt="Account">account_circle</span>
                </div>
            </header>

            <h2>Edit Menu Page</h2>
            <section>
                <div class="row">
                    <label for="cover-photo">Cover Photo</label>
                    <button type="button" class="image-btn">image</button>
                </div>

                <div>
                    <label for="cover-text">Cover Text</label>
                    <div class="row" style="gap: 1rem;">
                        <input id="cover-text" type="text" />
                        <button type="button" class="image-btn">save</button>
                    </div>
                </div>

                <div class="row">
                    <label for="category">Category</label>
                    <input id="category" type="text" />
                </div>

                <div class="row">
                    <label for="name">Name</label>
                    <input id="name" type="text" />
                </div>

                <div class="row">
                    <label for="temperature">Temperature</label>
                    <select id="temperature" name="temperature">
                        <option>Hot</option>
                        <option>Cold</option>
                    </select>

                    <label for="size">Size</label>
                    <select id="size" name="size">
                        <option>16oz</option>
                        <option>12oz</option>
                        <option>20oz</option>
                    </select>
                </div>

                <div class="row">
                    <label for="point">Point</label>
                    <input id="point" type="text" />
                </div>

                <div class="row">
                    <label for="price">Price</label>
                    <input id="price" type="text" />
                </div>

                <div class="row">
                    <label for="menu-image">Menu Image</label>
                    <button type="button" class="image-btn">image</button>
                </div>

                <button type="button" class="save-btn">save</button>
            </section>
        </main>
    </div>
</body>

</html>
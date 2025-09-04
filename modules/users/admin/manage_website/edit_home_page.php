<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <link rel="stylesheet" href="../../../../assets/css/edit_home_page.css">
    <title>Edit Home Page</title>
</head>

<body>
    <div class="main-container">
        <?php include("../sidebar_admin.php") ?>
        <main>
            <header>
                <a href="../sidebar_admin.php">
                    <span class="material-symbols-rounded" img alt="Menu">menu</span>
                </a>
                <div class="left">
                    <span>Manage Home</span>
                </div>
                <div class="right">
                    <span>Admin</span>
                    <span class="material-symbols-rounded" img alt="Account">account_circle</span>
                </div>
            </header>

            <h2>Edit Home Page</h2>
            <section>
                <div class="row">
                    <label for="cover-photo">Cover Photo</label>
                    <input type="file" name="fileupload">
                    <button type="submit" class="image-btn" name="submit">image</button>
                    <img src="">
                </div>

                <div>
                    <label for="cover-text">Cover Text</label>
                    <div class="row" style="gap: 1rem;">
                        <input id="cover-text" type="text" />
                        <button type="button" class="image-btn">save</button>
                    </div>
                </div>

                <div class="row">
                    <label for="menu-teaser">Menu Teaser</label>
                    <input type="file" name="fileupload" id="fileupload">
                    <button type="submit" value="Upload Image" class="image-btn" name="save">save</button>
                </div>

                <div class="textarea-group">
                    <label for="menu-description">Description</label>
                    <textarea id="menu-description" rows="3"></textarea>
                </div>

                <div class="row">
                    <label for="reward-teaser">Reward Teaser</label>
                    <input type="file" name="fileupload" id="fileupload">
                    <button type="submit" value="Upload Image" class="image-btn" name="save">save</button>
                </div>

                <div class="textarea-group">
                    <label for="reward-description">Description</label>
                    <textarea id="reward-description" rows="3"></textarea>
                </div>

                <button type="button" class="save-btn">save</button>
            </section>
        </main>
    </div>
</body>

</html>
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
                <form class="row" action="../../../../includes/upload0.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="cover-photo">Cover Photo</label>
                    <input type="file" name="fileupload" required>
                    <input type="hidden" name="source_table" value="homepage_cover">
                    <input type="hidden" name="source_id" value="5">
                    <button type="submit" class="image-btn">save</button>
                </form>

                <form class="row" action="../../../../includes/manage_web_inc/manage_text.inc.php" method="POST">
                    <label for="content">Cover Text</label>
                    <input type="text" name="content" required>

                    <input type="hidden" name="page" value="homepage_cover">
                    <input type="hidden" name="section" value="homepage_text">

                    <button type="submit" name="submit" class="image-btn">save</button>
                </form>




                <form class="row" action="../../../../includes/upload0.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="cover-photo">Menu Teaser</label>
                    <input type="file" name="fileupload" required>
                    <input type="hidden" name="source_table" value="menu_teaser">
                    <input type="hidden" name="source_id" value="5">
                    <button type="submit" class="image-btn">save</button>
                </form>

                <form class="textarea-group" action="../../../../includes/manage_web_inc/manage_text.inc.php" method="POST">
                    <label for="content">Description</label>
                    <input type="text" name="content" required>

                    <input type="hidden" name="page" value="menu_teaser">
                    <input type="hidden" name="section" value="menu_description">

                    <button type="submit" name="submit" class="image-btn">save</button>
                </form>

                <form class="row" action="../../../../includes/upload0.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="cover-photo">Reward Teaser</label>
                    <input type="file" name="fileupload" required>
                    <input type="hidden" name="source_table" value="reward_teaser">
                    <input type="hidden" name="source_id" value="5">
                    <button type="submit" class="image-btn">save</button>
                </form>

                <form class="textarea-group" action="../../../../includes/manage_web_inc/manage_text.inc.php" method="POST">
                    <label for="content">Description</label>
                    <input type="text" name="content" required>

                    <input type="hidden" name="page" value="reward_teaser">
                    <input type="hidden" name="section" value="reward_description">

                    <button type="submit" name="submit" class="image-btn">save</button>
                </form>
            </section>

            <h2>Edit Menu Page</h2>
            <section>
                <form action="../../../../includes/upload0.inc.php " method="POST" enctype="multipart/form-data">
                    <label for="cover-photo">Cover Photo</label>
                    <input type="file" name="fileupload" required>
                    <input type="hidden" name="source_table" value="menupage_cover">
                    <input type="hidden" name="source_id" value="5">
                    <button type="submit" class="image-btn">save</button>
                </form>

                <form class="row" action="../../../../includes/manage_web_inc/manage_text.inc.php" method="POST">
                    <label for="content">Cover Text</label>
                    <input type="text" name="content" required>

                    <input type="hidden" name="page" value="menupage_cover">
                    <input type="hidden" name="section" value="menu_text">

                    <button type="submit" name="submit" class="image-btn">save</button>
                </form>

            </section>
        </main>
    </div>
</body>

</html>
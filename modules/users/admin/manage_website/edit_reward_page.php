<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <link rel="stylesheet" href="../../../../assets/css/edit_reward_page.css">
    <title>Edit Reward Page</title>
</head>

<body>
    <div class="main-container">
        <?php include("../sidebar_admin.php") ?>
        <main>
            <header>
                <span class="material-symbols-rounded" img alt="toggle">menu</span>
                <div class="left">
                    <span>Manage Reward</span>
                </div>
                <div class="right">
                    <span>Admin</span>
                    <span class="material-symbols-rounded" img alt="Account">account_circle</span>
                </div>
            </header>

            <h2>Edit Reward Page</h2>
            <section>
                <div class="row">
                    <label for="cover-photo">Cover Photo</label>
                    <input type="file" name="fileupload" id="fileupload">
                    <button type="submit" value="Upload Image" class="image-btn" name="save">save</button>
                </div>

                <div>
                    <label for="cover-text">Cover Text</label>
                    <div class="row" style="gap: 1rem;">
                        <input id="cover-text" type="text" />
                        <input type="file" name="fileupload" id="fileupload">
                        <button type="submit" value="Upload Image" class="image-btn" name="save">save</button>
                    </div>
                </div>

                <p>Add Reward:</p>

                <form>
                    <div class="form-row">
                        <label for="category">Category</label>
                        <input id="category" type="text" aria-label="Category" />
                    </div>

                    <div class="form-row">
                        <label for="name">Name</label>
                        <input id="name" type="text" aria-label="Name" />
                    </div>

                    <div class="form-row">
                        <label for="percent">Percent</label>
                        <select id="percent" aria-label="Percent">
                            <option>5%</option>
                            <option>10%</option>
                            <option>15%</option>
                            <option>20%</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="valid-date">Valid Date</label>
                        <input id="valid-date" type="date" aria-label="Valid Date" />
                    </div>

                    <div class="textarea-group">
                        <label for="menu-description">Description</label>
                        <textarea id="menu-description" rows="3"></textarea>
                    </div>

                    <button class="save-btn" type="submit">save</button>
                </form>
            </section>
        </main>
    </div>
</body>

</html>
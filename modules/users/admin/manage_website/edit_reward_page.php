<?php
require_once __DIR__ . '/../../../../includes/dbconnect.php';
require_once __DIR__ . '/../../../../includes/reward_func.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Only read POST data when form is submitted
    $data = [
        'name'        => $_POST['name'] ?? '',
        'category'    => $_POST['category'] ?? '',
        'start_date'  => $_POST['start_date'] ?? '',
        'expired_date' => $_POST['expired_date'] ?? '',
        'point'       => (int) ($_POST['point'] ?? 0)
    ];

    $result = addReward($pdo, $data);

    if ($result) {
        echo "";
    } else {
        echo "";
    }
}
?>



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
                <div>
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
                </div>

                <p>Add Reward:</p>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <label for="category">Category</label>
                        <input id="category" type="text" name="category" />
                    </div>

                    <div class="form-row">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" />
                    </div>

                    <div class="form-row">
                        <label for="point">Points</label>
                        <input id="point" type="number" name="point" min="0" value="0" />
                    </div>

                    <div class="form-row">
                        <label for="percent">Percent</label>
                        <select id="percent" name="percent">
                            <option>5%</option>
                            <option>10%</option>
                            <option>15%</option>
                            <option>20%</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="start_date">Start Date</label>
                        <input id="start_date" type="date" name="start_date" />
                    </div>

                    <div class="form-row">
                        <label for="expired_date">Expired Date</label>
                        <input id="expired_date" type="date" name="expired_date" />
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
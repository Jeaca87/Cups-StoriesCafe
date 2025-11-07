<?php
require_once __DIR__ . '/../../../../includes/dbconnect.php';
require_once __DIR__ . '/../../../../includes/reward_func.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name'          => $_POST['name'] ?? '',
        'category'      => $_POST['category'] ?? '',
        'percent'     => $_POST['percent'] ?? 0,
        'start_date'    => $_POST['start_date'] ?? '',
        'expired_date'  => $_POST['expired_date'] ?? '',
        'point'         => (int)($_POST['point'] ?? 0),
        'description' => $_POST['description'] ?? ''
    ];

    $result = addReward($pdo, $data);
    echo $result ? "" : "";
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
                    <form class="row" action="../../../../includes/upload0.inc.php" method="POST" enctype="multipart/form-data">
                        <label for="cover-photo">Cover Photo</label>
                        <input type="file" name="fileupload" id="fileupload" required>
                        <input type="hidden" name="source_table" value="rewardpage_cover">
                        <input type="hidden" name="source_id" value="5">
                        <button type="submit" class="image-btn" name="save">save</button>
                    </form>

                    <form style="gap: 1rem;" class="row" action="../../../../includes/manage_web_inc/manage_text.inc.php" method="POST">
                        <label for="content">Cover Text</label>
                        <input type="text" name="content" required>

                        <input type="hidden" name="page" value="homepage_cover">
                        <input type="hidden" name="section" value="homepage_text">

                        <button type="submit" name="submit" class="image-btn">save</button>
                    </form>
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
                        <select id="percent" type="text" name="percent">
                            <option value=0>0%</option>
                            <option value=5>5%</option>
                            <option value=10>10%</option>
                            <option value=15>15%</option>
                            <option value=20>20%</option>
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
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>

                    <button class="save-btn" type="submit">save</button>
                </form>
            </section>
        </main>
    </div>
</body>

</html>
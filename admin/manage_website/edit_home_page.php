<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Homepage</title>
</head>
<body>
    <div>
        <nav>
            <h3>Manage Home</h3>
            <h3>Admin</h3>
        </nav>
    </div>
    <form method="POST" action="includes/upload.php">
        <div>
            <h4>Edit Home Page</h4>
        </div>

        <div>
            <div>
                <h5>Cover Photo</h5>
                <input type="file" name="fileupload" id="fileupload">
                <input type="submit" value="Upload Image" name="save">
            </div>

            <div>
                <h5>Cover Text</h5>
                <textarea name="text" rows="5" cols="20"></textarea>
            </div>

            <div>
                <h5>Menu Teaser</h5>
                <input type="file" name="fileupload" id="fileupload">
                <input type="submit" value="Upload Image" name="save">
                <div>
                    <h5>Description</h5>
                    <textarea name="text" rows="5" cols="20"></textarea>
                </div>
            </div>

            <div>
                <h5>Reward Teaser</h5>
                <input type="file" name="fileupload" id="fileupload">
                <input type="submit" value="Upload Image" name="save">
                <div>
                    <h5>Description</h5>
                    <textarea name="text" rows="5" cols="20"></textarea>
                </div>
            </div>
            <button>save</button>
        </div>
    </form>
</body>
</html>
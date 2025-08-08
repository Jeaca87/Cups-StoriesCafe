<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reward</title>
</head>
<body>
    <div>
        <div>
            <nav>
                <h3>Manage Reward</h3>
                <h3>Admin</h3>
            </nav>
        </div>

        <div>
            <h4>Edit Reward Page</h4>
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
                <h5>Add Reward</h5>
            </div>

            <div>
                <h5>Category</h5>
                <input type="category" id="category">
            </div>

            <div>
                <h5>Name</h5>
                <input type="name" id="Mname">
            </div>

            <div>
                <h5>Percent</h5>
                <select>
                    <option value="">Select Percent Voucher</option>
                    <option value="5%">5%</option>
                    <option value="10%">10%</option>
                    <option value="15%">15%</option>
                    <option value="20%">20%</option>
                </select>
            </div>

            <div>
                <h5>Valid Date</h5>
                <input type="date" id="date">
            </div>

            <div>
                <h5>Description</h5>
                <textarea name="text" rows="5" cols="20"></textarea>
            </div>
            <button>save</button>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Picture</title>
</head>
<body>
    <h1>Upload a Picture</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="picture" required>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="gallery.php">View Gallery</a>
</body>
</html>

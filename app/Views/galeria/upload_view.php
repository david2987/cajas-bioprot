<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Images</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Upload Multiple Images</h1>
        <form action="/gallery/upload" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
            <div class="form-group">
                <label>Select Images</label>
                <input type="file" name="images[]" multiple class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>

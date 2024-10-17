<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Image Gallery</h1>
        <div class="row">
            <?php foreach($images as $image): ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="<?= base_url(''.$image['image_path']) ?>" class="card-img-top" alt="Image">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

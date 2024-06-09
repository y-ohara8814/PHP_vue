<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php
    // confirm.phpからPOSTされた値を取得
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $pinning = isset($_POST['pinning']) && $_POST['pinning'] == 1 ? 1 : 0;
    $private = isset($_POST['private']) && $_POST['private'] == 1 ? 1 : 0;
    $published_date = isset($_POST['published_date']) ? $_POST['published_date'] : '';

    // confirm.phpからPOSTされた画像ファイル名を取得
    $image1_file = isset($_POST['image1_file']) ? $_POST['image1_file'] : '';
    $image2_file = isset($_POST['image2_file']) ? $_POST['image2_file'] : '';
    $image3_file = isset($_POST['image3_file']) ? $_POST['image3_file'] : '';
    ?>

    <form method="post" action="confirm2.php" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>

        <label for="text">Text:</label>
        <textarea name="text" id="text" required><?php echo htmlspecialchars($text); ?></textarea><br><br>

        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="">Select Category</option>
            <option value="BOM" <?php echo $category == 'BOM' ? 'selected' : ''; ?>>BOM</option>
            <option value="CON" <?php echo $category == 'CON' ? 'selected' : ''; ?>>CON</option>
            <option value="FRO" <?php echo $category == 'FRO' ? 'selected' : ''; ?>>FRO</option>
            <option value="YUGI" <?php echo $category == 'YUGI' ? 'selected' : ''; ?>>YUGI</option>
        </select><br><br>

        <label>
            <input type="checkbox" name="pinning" value="1" <?php echo $pinning == 1 ? 'checked' : ''; ?>>
            Pinning
        </label><br><br>

        <label>
            <input type="checkbox" name="private" value="1" <?php echo $private == 1 ? 'checked' : ''; ?>>
            Private
        </label><br><br>

        <label for="image1">Image 1:</label>
        <input type="file" name="image1" id="image1" value="<?php echo htmlspecialchars($image1_file); ?>"><br><br>

        <label for="image2">Image 2:</label>
        <input type="file" name="image2" id="image2" value="<?php echo htmlspecialchars($image2_file); ?>"><br><br>

        <label for="image3">Image 3:</label>
        <input type="file" name="image3" id="image3" value="<?php echo htmlspecialchars($image3_file); ?>"><br><br>

        <label for="published_date">Published Date:</label>
        <input type="date" name="published_date" id="published_date" value="<?php echo htmlspecialchars($published_date); ?>" required><br><br>

        <input type="submit" value="Confirm">
    </form>
</body>
</html>

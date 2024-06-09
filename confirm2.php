<!DOCTYPE html>
<html>
<head>
    <title>Confirm</title>
</head>
<body>
    <h1>Confirm</h1>
    <ul>
        <li><strong>Title:</strong> <?php echo htmlspecialchars($_POST['title']); ?></li>
        <li><strong>Text:</strong> <?php echo nl2br(htmlspecialchars($_POST['text'])); ?></li>
        <li><strong>Category:</strong> <?php echo htmlspecialchars($_POST['category']); ?></li>
        <li><strong>Pinning:</strong> <?php echo isset($_POST['pinning']) ? 'Yes' : 'No'; ?></li>
        <li><strong>Private:</strong> <?php echo isset($_POST['private']) ? 'Yes' : 'No'; ?></li>
        <li><strong>Image 1:</strong> <?php echo isset($_FILES['image1']) && $_FILES['image1']['error'] == UPLOAD_ERR_OK ? $_FILES['image1']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Image 2:</strong> <?php echo isset($_FILES['image2']) && $_FILES['image2']['error'] == UPLOAD_ERR_OK ? $_FILES['image2']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Image 3:</strong> <?php echo isset($_FILES['image3']) && $_FILES['image3']['error'] == UPLOAD_ERR_OK ? $_FILES['image3']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Published Date:</strong> <?php echo htmlspecialchars($_POST['published_date']); ?></li>
    </ul>

    <?php
    $upload_dir = 'img/tmp/';
    $tmp_file1 = $upload_dir . basename($_FILES['image1']['name']);
    move_uploaded_file($_FILES['image1']['tmp_name'], $tmp_file1);
    ?>
    <form method="post" action="register2.php">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']); ?>">
        <input type="hidden" name="text" value="<?php echo htmlspecialchars($_POST['text']); ?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']); ?>">
        <input type="hidden" name="pinning" value="<?php echo isset($_POST['pinning']) ? 1 : 0; ?>">
        <input type="hidden" name="private" value="<?php echo isset($_POST['private']) ? 1 : 0; ?>">
        <input type="hidden" name="published_date" value="<?php echo htmlspecialchars($_POST['published_date']); ?>">
        <input type="hidden" name="tmp_file1" value="<?php echo $tmp_file1; ?>">
        <input type="hidden" name="file1_name" value="<?php echo $file1_name; ?>">
        <input type="hidden" name="tmp_file2" value="<?php echo $tmp_file2; ?>">
        <input type="hidden" name="file2_name" value="<?php echo $file2_name; ?>">
        <input type="submit" value="Back to Input Form">
    </form>
    <form method="post" action="db.php">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']); ?>">
        <input type="hidden" name="text" value="<?php echo htmlspecialchars($_POST['text']); ?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']); ?>">
        <input type="hidden" name="pinning" value="<?php echo isset($_POST['pinning']) ? 1 : 0; ?>">
        <input type="hidden" name="private" value="<?php echo isset($_POST['private']) ? 1 : 0; ?>">
        <input type="hidden" name="published_date" value="<?php echo htmlspecialchars($_POST['published_date']); ?>">
        <input type="hidden" name="tmp_file1" value="<?php echo $tmp_file1; ?>">
        <input type="hidden" name="file1_name" value="<?php echo $file1_name; ?>">
        <input type="hidden" name="tmp_file2" value="<?php echo $tmp_file2; ?>">
        <input type="hidden" name="file2_name" value="<?php echo $file2_name; ?>">
        <input type="submit" value="Register Exec">
    </form>
</body>
</html>

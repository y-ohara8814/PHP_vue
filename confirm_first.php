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
        <li><strong>Image 1:</strong> <?php echo isset($_FILES['image1']) ? $_FILES['image1']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Image 2:</strong> <?php echo isset($_FILES['image2']) ? $_FILES['image2']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Image 3:</strong> <?php echo isset($_FILES['image3']) ? $_FILES['image3']['name'] : 'No file uploaded'; ?></li>
        <li><strong>Published Date:</strong> <?php echo htmlspecialchars($_POST['published_date']); ?></li>
    </ul>
    <form method="post" action="register_first.php">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']); ?>">
        <input type="hidden" name="text" value="<?php echo htmlspecialchars($_POST['text']); ?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']); ?>">
        <input type="hidden" name="pinning" value="<?php echo isset($_POST['pinning']) ? 1 : 0; ?>">
        <input type="hidden" name="private" value="<?php echo isset($_POST['private']) ? 1 : 0; ?>">
        <input type="hidden" name="published_date" value="<?php echo htmlspecialchars($_POST['published_date']); ?>">
        <input type="hidden" name="image1" value="<?php echo isset($_FILES['image1']) ? $_FILES['image1']['tmp_name'] : ''; ?>">
        <input type="hidden" name="image2" value="<?php echo isset($_FILES['image2']) ? $_FILES['image2']['tmp_name'] : ''; ?>">
        <input type="hidden" name="image3" value="<?php echo isset($_FILES['image3']) ? $_FILES['image3']['tmp_name'] : ''; ?>">
        <input type="submit" value="Back to Input Form">
    </form>
    <form method="post" action="db.php">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']); ?>">
        <input type="hidden" name="text" value="<?php echo htmlspecialchars($_POST['text']); ?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']); ?>">
        <input type="hidden" name="pinning" value="<?php echo isset($_POST['pinning']) ? 1 : 0; ?>">
        <input type="hidden" name="private" value="<?php echo isset($_POST['private']) ? 1 : 0; ?>">
        <input type="hidden" name="published_date" value="<?php echo htmlspecialchars($_POST['published_date']); ?>">
        <input type="hidden" name="image1" value="<?php echo isset($_FILES['image1']) ? $_FILES['image1']['tmp_name'] : ''; ?>">
        <input type="hidden" name="image2" value="<?php echo isset($_FILES['image2']) ? $_FILES['image2']['tmp_name'] : ''; ?>">
        <input type="hidden" name="image3" value="<?php echo isset($_FILES['image3']) ? $_FILES['image3']['tmp_name'] : ''; ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

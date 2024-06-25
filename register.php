<!DOCTYPE html>
<html>
<head>
    <title>記事登録</title>
</head>
<body>
    <h1>記事登録</h1>
    <form action="db.php" method="post" enctype="multipart/form-data">
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="text">本文:</label>
        <textarea id="text" name="text" required></textarea><br><br>

        <label for="category">カテゴリ:</label>
        <select id="category" name="category" required>
            <option value="bomber">bomber</option>
            <option value="con">con</option>
            <option value="frog">frog</option>
            <option value="yu-gi">yu-gi</option>
        </select><br><br>

        <label for="image1">画像1:</label>
        <input type="file" id="image1" name="image1" required><br><br>

        <label for="image2">画像2:</label>
        <input type="file" id="image2" name="image2" required><br><br>

        <label for="release_date">リリース日:</label>
        <input type="date" id="release_date" name="release_date" required><br><br>

        <input type="submit" value="送信">
    </form>
</body>
</html>

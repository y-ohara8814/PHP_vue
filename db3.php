<?php
session_start();

// データベース接続情報
$servername = "mysql";
$username = "test";
$password = "test";
$dbname = "test";

// データベース接続
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("接続失敗: " . $e->getMessage());
}


// $conn = new mysqli($servername, $username, $password, $dbname);

// // // 接続確認
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


// セッションからデータを取得
$form_data = $_SESSION['form_data'];
$uploaded_files = $_SESSION['uploaded_files'];

// 画像の移動と保存
$image_paths = [];
for ($i = 1; $i <= 3; $i++) {
    if (isset($uploaded_files["image{$i}"])) {
        $tmp_path = $uploaded_files["image{$i}"];
        $new_path = "news/uploads/" . $form_data['category'] . "/" . basename($tmp_path);
        if (rename($tmp_path, $new_path)) {
            $image_paths["image{$i}_path"] = $new_path;
        }
    } else {
        $image_paths["image{$i}_path"] = null;
    }
}

// データベースに保存
try {
    $stmt = $conn->prepare("INSERT INTO News_posts (title, text, category, image1_path, image2_path, image3_path, release_date, last_update_date) VALUES (:title, :text, :category, :image1_path, :image2_path, :image3_path, :release_date, :last_update_date)");

    $stmt->bindParam(':title', $form_data['title']);
    $stmt->bindParam(':text', $form_data['content']);
    $stmt->bindParam(':category', $form_data['category']);
    $stmt->bindParam(':image1_path', $image_paths['image1_path']);
    $stmt->bindParam(':image2_path', $image_paths['image2_path']);
    $stmt->bindParam(':image3_path', $image_paths['image3_path']);
    $stmt->bindParam(':release_date', $form_data['publish_date']);
    $stmt->bindParam(':last_update_date', date('Y-m-d'));

    $stmt->execute();

    echo "新しい記事が正常に保存されました。";
} catch(PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// セッションのクリア
session_unset();
session_destroy();

// データベース接続を閉じる
$conn = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>処理完了</title>
</head>
<body>
    <h1>処理完了</h1>
    <p>記事の保存が完了しました。</p>
    <a href="register3.php">新しい記事を作成する</a>
</body>
</html>

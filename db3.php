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

// セッションからデータを取得
$form_data = $_SESSION['form_data'];
$uploaded_files = $_SESSION['uploaded_files'];

// トランザクション開始
$conn->beginTransaction();

try {
    // 最初にレコードを挿入して、IDを取得
    $stmt = $conn->prepare("INSERT INTO News_posts (title, text, category, release_date, last_update_date) VALUES (:title, :text, :category, :release_date, :last_update_date)");

    $stmt->bindParam(':title', $form_data['title']);
    $stmt->bindParam(':text', $form_data['content']);
    $stmt->bindParam(':category', $form_data['category']);
    $stmt->bindParam(':release_date', $form_data['publish_date']);
    $stmt->bindParam(':last_update_date', date('Y-m-d'));

    $stmt->execute();

    // 挿入されたレコードのIDを取得
    $post_id = $conn->lastInsertId();

    // 画像の移動と保存
    $image_paths = [];
    for ($i = 1; $i <= 3; $i++) {
        if (isset($uploaded_files["image{$i}"])) {
            $tmp_path = $uploaded_files["image{$i}"];
            $new_dir = "news/uploads/" . $form_data['category'] . "/" . $post_id;

            // ディレクトリが存在しない場合は作成
            if (!is_dir($new_dir)) {
                mkdir($new_dir, 0777, true);
            }

            $new_path = $new_dir . "/" . basename($tmp_path);
            if (rename($tmp_path, $new_path)) {
                $image_paths["image{$i}_path"] = $new_path;
                // tmpディレクトリ内の同ファイルを削除
                $tmp_file = "news/uploads/" . $form_data['category'] . "/tmp/" . basename($tmp_path);
                if (file_exists($tmp_file)) {
                    unlink($tmp_file);
                }
            } else {
                throw new Exception("ファイルの移動に失敗しました: image{$i}");
            }
        } else {
            $image_paths["image{$i}_path"] = null;
        }
    }

    // 画像パスの更新
    $stmt = $conn->prepare("UPDATE News_posts SET image1_path = :image1_path, image2_path = :image2_path, image3_path = :image3_path WHERE id = :id");

    $stmt->bindParam(':id', $post_id);
    $stmt->bindParam(':image1_path', $image_paths['image1_path']);
    $stmt->bindParam(':image2_path', $image_paths['image2_path']);
    $stmt->bindParam(':image3_path', $image_paths['image3_path']);

    $stmt->execute();

    // トランザクションをコミット
    $conn->commit();

    echo "新しい記事が正常に保存されました。";
} catch(Exception $e) {
    // エラーが発生した場合はロールバック
    $conn->rollBack();
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

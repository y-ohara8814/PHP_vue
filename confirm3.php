<?php
// セッションを開始して入力データを保持
session_start();

// POSTデータをセッションに保存
$_SESSION['form_data'] = $_POST;

// カテゴリーを取得
$category = $_POST['category'];

// アップロード先のベースディレクトリ
$base_upload_dir = "news/uploads/{$category}/tmp/";

// ディレクトリが存在しない場合は作成
if (!is_dir($base_upload_dir)) {
    mkdir($base_upload_dir, 0777, true);
}

// ファイルアップロードの処理
$uploaded_files = [];
for ($i = 1; $i <= 5; $i++) {
    if (isset($_FILES["image{$i}"]) && $_FILES["image{$i}"]['error'] == 0) {
        $tmp_name = $_FILES["image{$i}"]["tmp_name"];
        $name = $_FILES["image{$i}"]["name"];
        $new_file_path = $base_upload_dir . $name;

        // ファイル名が重複する場合、ユニークな名前を生成
        $counter = 1;
        while (file_exists($new_file_path)) {
            $info = pathinfo($name);
            $new_file_path = $base_upload_dir . $info['filename'] . '_' . $counter . '.' . $info['extension'];
            $counter++;
        }

        // ファイルを移動
        if (move_uploaded_file($tmp_name, $new_file_path)) {
            $uploaded_files["image{$i}"] = $new_file_path;  // フルパスを保存
        } else {
            // エラー処理
            echo "ファイルのアップロードに失敗しました: image{$i}<br>";
        }
    } elseif (isset($_POST["existing_image{$i}"])) {
        // 既存のアップロード済みファイルパスを保持
        $uploaded_files["image{$i}"] = $_POST["existing_image{$i}"];
    }
}
$_SESSION['uploaded_files'] = $uploaded_files;

// XSS対策
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認画面</title>
</head>
<body>
    <h1>入力内容の確認</h1>
    <dl>
        <dt>タイトル:</dt>
        <dd><?php echo h($_POST['title']); ?></dd>

        <dt>テキスト:</dt>
        <dd><?php echo $_POST['content']; ?></dd>

        <dt>カテゴリー:</dt>
        <dd><?php echo h($_POST['category']); ?></dd>

        <dt>公開日:</dt>
        <dd><?php echo h($_POST['publish_date']); ?></dd>

        <dt>公開状態:</dt>
        <dd><?php echo isset($_POST['is_published']) ? '公開' : '非公開'; ?></dd>

        <?php
        for ($i = 1; $i <= 5; $i++) {
            if (isset($uploaded_files["image{$i}"])) {
                echo "<dt>画像 {$i}:</dt>";
                echo "<dd>" . h(basename($uploaded_files["image{$i}"])) . "</dd>";
            }
        }
        ?>
    </dl>

    <form action="db3.php" method="post">
        <input type="submit" value="確定">
    </form>
    <form action="register3.php" method="get">
        <input type="submit" value="戻る">
    </form>
</body>
</html>

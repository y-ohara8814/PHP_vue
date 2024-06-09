<?php

var_dump($_POST);

$tmp_file1 = realpath($_POST['tmp_file1']);
$file1_name = basename($tmp_file1);

$upload_dir = 'img/';
$file1_path = $upload_dir . $file1_name;
var_dump($tmp_file1);

move_uploaded_file($tmp_file1, $file1_path);
var_dump(move_uploaded_file($tmp_file1, $file1_path));
echo 'move finish';
exit;

// データベース接続設定
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ny_new";

$conn = new mysqli($servername, $username, $password, $dbname);

// // 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// フォームデータの取得
$title = $_POST['title'];
$text = $_POST['text'];
$category = $_POST['category'];
$release_date = $_POST['release_date'];

// 画像ファイルの取得
// $image1 = $_FILES['image1']['tmp_name'];
// $image1_name = $_FILES['image1']['name'];
// $image2 = $_FILES['image2']['tmp_name'];
// $image2_name = $_FILES['image2']['name'];

$tmp_file1 = $_POST['tmp_file1'];
$file1_name = $_POST['file1_name'];
$tmp_file2 = $_POST['tmp_file2'];
$file2_name = $_POST['file2_name'];

// 一時ディレクトリのパス
$tmp_dir = __DIR__ . '/news/uploads/' . $category . '/tmp';

// 一時ディレクトリの作成
if (!is_dir($tmp_dir)) {
    mkdir($tmp_dir, 0755, true);
}

// 画像ファイルを一時ディレクトリに移動
$tmp_image1_path = $tmp_dir . '/' . $image1_name;
$tmp_image2_path = $tmp_dir . '/' . $image2_name;
move_uploaded_file($image1, $tmp_image1_path);
move_uploaded_file($image2, $tmp_image2_path);

// データベースにレコードを挿入
$sql = "INSERT INTO News_posts (title, text, category, release_date) VALUES ('$title', '$text', '$category', '$release_date')";
if ($conn->query($sql) === TRUE) {
    $id = $conn->insert_id; // 発行された ID を取得

    // 本番ディレクトリのパス
    $prod_dir = __DIR__ . '/news/uploads/' . $category . '/9';

    // 本番ディレクトリの作成
    if (!is_dir($prod_dir)) {
        mkdir($prod_dir, 0755, true);
    }

    // 一時ディレクトリから本番ディレクトリへ画像ファイルを移動
    $image1_path = $prod_dir . '/' . $image1_name;
    $image2_path = $prod_dir . '/' . $image2_name;
    rename($tmp_image1_path, $image1_path);
    rename($tmp_image2_path, $image2_path);

    removeFiles($tmp_dir);


    // 画像のパスを変数に保存 (ここでは使用していない)
    $image_1_path = $image1_path;
    $image_2_path = $image2_path;

    header("Location: list.php"); // 一覧ページへリダイレクト
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('/path/to/templates');
$twig = new \Twig\Environment($loader);

// サンプルデータを作成
$data = [];
for ($i = 1; $i <= 10; $i++) {
    $data[] = [
        'name' => "Name $i",
        'job' => "Job $i",
        'comment' => "This is comment $i."
    ];
}

// データを分割
$data1 = array_slice($data, 0, 3); // 最初の3つ
$data2 = array_slice($data, 3, 3); // 次の3つ
$data3 = array_slice($data, 6, 4); // 最後の4つ

// Twigテンプレートにデータを渡す
echo $twig->render('introduction.twig', [
    'data1' => $data1,
    'data2' => $data2,
    'data3' => $data3
]);

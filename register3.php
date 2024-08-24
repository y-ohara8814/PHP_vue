<?php
session_start();

// セッションからデータを取得
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$uploaded_files = isset($_SESSION['uploaded_files']) ? $_SESSION['uploaded_files'] : [];

// フォーム送信後はセッションをクリア
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_unset();
}

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
    <title>入力フォーム</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/s/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(function() {
            $("#publish_date").datepicker({ dateFormat: 'yy-mm-dd' });
        });
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(<?php echo json_encode(isset($form_data['content']) ? $form_data['content'] : ''); ?>);
                });
            }
        });
    </script>
</head>
<body>
    <h1>入力フォーム</h1>
    <form action="confirm3.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="title">タイトル:</label>
            <input type="text" id="title" name="title" required value="<?php echo isset($form_data['title']) ? h($form_data['title']) : ''; ?>">
        </div>

        <div>
            <label for="content">テキスト:</label>
            <textarea id="content" name="content"></textarea>
        </div>

        <div>
            <label for="category">カテゴリー:</label>
            <select id="category" name="category" required>
                <option value="">選択してください</option>
                <?php
                $categories = ['bomber', 'contra', 'frogger', 'yugioh'];
                foreach ($categories as $cat) {
                    $selected = (isset($form_data['category']) && $form_data['category'] === $cat) ? 'selected' : '';
                    echo "<option value=\"" . h($cat) . "\" $selected>" . h($cat) . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="publish_date">公開日:</label>
            <input type="text" id="publish_date" name="publish_date" required value="<?php echo isset($form_data['publish_date']) ? h($form_data['publish_date']) : ''; ?>">
        </div>

        <div>
            <label for="is_published">公開する:</label>
            <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo isset($form_data['is_published']) ? 'checked' : ''; ?>>
        </div>
        <?php
            for ($i = 1; $i <= 5; $i++) {
                echo "<div>";
                echo "<label for='image{$i}'>画像アップロード {$i}:</label>";
                if (isset($uploaded_files["image{$i}"])) {
                    echo "<p>現在のファイル: " . h(basename($uploaded_files["image{$i}"])) . "</p>";
                    echo "<input type='hidden' name='existing_image{$i}' value='" . h($uploaded_files["image{$i}"]) . "'>";
                }
                echo "<input type='file' id='image{$i}' name='image{$i}' accept='image/*'>";
                echo "</div>";
            }
        ?>

        <div>
            <input type="submit" value="送信">
        </div>
    </form>
</body>
</html>

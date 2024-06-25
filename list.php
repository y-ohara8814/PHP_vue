<!DOCTYPE html>
<html>
<head>
    <title>記事一覧</title>
</head>
<body>
    <h1>記事一覧</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>リリース日</th>
        </tr>
        <?php
        // データベース接続設定
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "ny_new";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // 接続確認
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // データを取得
        $sql = "SELECT id, title, release_date FROM news";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // データを表示
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["release_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>データがありません</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>

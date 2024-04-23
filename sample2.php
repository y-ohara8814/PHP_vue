<?php
var_dump($_POST);

$file_1_path = 'sample.png'

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@3.2/dist/vue.global.js"></script>

</head>
<body>
    <div id="app">



    </div>


<script>
const textFromPHP = <?php echo json_encode($_POST['editor1']); ?>;
const file_1_Path = '<?php echo $file_1_path; ?>';

const originalString = "ここには {#image1} があります。";
// const imagePath = 's/img' + this.file_1_Path;
// const replacedString = originalString.replace(/\{#image1\}/g, `<img src="${imagePath}">`);
// console.log(replacedString); // 置換後の文字列を出力

    const app = Vue.createApp({
        data() {
            return {
                text: textFromPHP, // JSON形式に変換した値をVue.jsのdataに代入
                imagePath: 's/img/' + file_1_Path // Vue.jsのデータとしてファイルパスを保持

            }
        },
        methods: {
            replaceString(originalString) {
                console.log(originalString.replace(/\{#image1\}/g, `<img src="${this.imagePath}">`));
            }
        },
        mounted() {
            this.replaceString("ここには {#image1} があります。"); // ページ表示時にreplaceStringメソッドを呼び出す
        }
    });

    app.mount('#app');
</script>
</body>
</html>

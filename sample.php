<?php

?>

<!DOCTYPE html>

<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@3.2/dist/vue.global.js"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>

<body>
    <div id="app">
        <form method="post" action="./sample2.php">


                <textarea name="editor1" id="editor"></textarea>
                <br>
                <!-- <div>{{ textareaInput }}</div> -->
                <div v-html="textareaInput"></div>
                <input type="submit" value="送信" />
        </form>
    </div>
    <script>

    const app = Vue.createApp({
      data() {
        return {
          textareaInput: '' // CKEditorの入力値を保持するデータプロパティ
        }
      },
      mounted() {
        // CKEditorの初期化
        CKEDITOR.replace('editor', {
          // CKEditorの設定を追加
          // ここに必要な設定を追加
          // 例: toolbar, language, width, heightなど
        }).on('change', () => {
          // textareaの値が変更された時に、Vue.jsのデータを更新
          this.textareaInput = CKEDITOR.instances.editor.getData();
        });
      }
    });

    app.mount('#app');
                </script>




<script>
</script>
</body>
</html>

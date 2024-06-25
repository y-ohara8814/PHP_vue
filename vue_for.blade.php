<?php
// 適当な配列を定義します
$jsonArray = [
    ['id' => 1, 'title' => '記事1', 'text' => '記事1の内容', 'post_id' => 123, 'image_path' => 'news/uploads/someimage1.jpg'],
    ['id' => 2, 'title' => '記事2', 'text' => '記事2の内容', 'post_id' => 456, 'image_path' => 'news/uploads/someimage2.jpg'],
    ['id' => 3, 'title' => '記事3', 'text' => '記事3の内容', 'post_id' => 789, 'image_path' => 'news/uploads/someimage3.jpg'],
    ['id' => 4, 'title' => '記事4', 'text' => '記事4の内容', 'post_id' => 101112, 'image_path' => 'news/uploads/someimage4.jpg'],
    ['id' => 5, 'title' => '記事5', 'text' => '記事5の内容', 'post_id' => 131415, 'image_path' => 'news/uploads/someimage5.jpg'],
    // さらに適当なデータを追加することもできます
];

// JSON形式にエンコードします
$jsonArrayEncoded = json_encode($jsonArray);
?>

<div id="app">
    <div v-for="item in topFourItems" :key="item.id" class="item-container">
        <h3>{{ item.title }}</h3>
        <img :src="item.image_path" alt="記事画像" width="100" height="100"> <!-- 画像の表示 -->
        <p v-html="linkifyText(item.text)"></p>
        <a :href="`detail/${item.post_id}/detail.php`">詳細</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
<script>
    const jsonArray = <?php echo $jsonArrayEncoded; ?>;

    const app = Vue.createApp({
        data() {
            return {
                originalArray: jsonArray
            }
        },
        computed: {
            topFourItems() {
                return this.originalArray.slice(0, 4);
            }
        },
        methods: {
            linkifyText(text) {
                const linkifiedText = `<a href="detail/${text}/">${text}</a>`;
                return linkifiedText;
            }
        }
    });
    app.mount('#app');
</script>

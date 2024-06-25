<!DOCTYPE html>

<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@3.2/dist/vue.global.js"></script>
</head>

<body>
    <?php // 元の配列
$originalArray = [
    ['id' => 1, 'title' => 'sometitle', 'text' => 'sometext', 'ps4' => true, 'ps5' => '', 'xbox' => '', 'android' => '', 'ios' => '', 'post_id' => 1],
    ['id' => 2, 'title' => 'sometitle', 'text' => 'sometext', 'ps4' => true, 'ps5' => 'true', 'xbox' => '', 'android' => '', 'ios' => '', 'post_id' => 3],
    ['id' => 3, 'title' => 'sometitle', 'text' => 'sometext', 'ps4' => '', 'ps5' => '', 'xbox' => '', 'android' => 'true', 'ios' => '', 'post_id' => 4],
    ['id' => 4, 'title' => 'sometitle', 'text' => 'sometext', 'ps4' => '', 'ps5' => '', 'xbox' => '', 'android' => 'true', 'ios' => 'true', 'post_id' => 6]
];

$jsonArray = json_encode($originalArray);

// 先頭4つの要素を別の配列に格納
// $topFourItems = array_slice($originalArray, 0, 4);
?>

        <!-- post.blade.php -->
        <div id="app">
    <div v-for="item in topFourItems" :key="item.id" class="item-container">
        <h3>{{ item.title }}</h3>
        <p>{{ item.text }}</p>
        <p>Post ID: {{ item.post_id }}</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
<script>
    const app = Vue.createApp({
        data() {
            return {
                // originalArray: @json($originalArray)
                originalArray: <?php echo $jsonArray; ?>
            }
        },
        computed: {
            topFourItems() {
                return this.originalArray.slice(0, 1);
            }
        }
    });
    app.mount('#app');
</script>
</body>
</html>

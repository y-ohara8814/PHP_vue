<?php
$imagePath1 = '/img/sample.jpg';
$imagePath2 = '/img/sample2.jpg';
?>


<html>
    <head>
</head>
<body>
<div id="app">
  <!-- <ul class="tabMenu">
    <li @click="isSelect('1')">All</li>
    <li @click="isSelect('2')">News</li>
    <li @click="isSelect('3')">Event</li>
  </ul>
  <div class="tabContents">
    <div v-if="isActive === '1'">Tab All</div>
    <div v-else-if="isActive === '2'">Tab News</div>
    <div v-else-if="isActive === '3'">Tab Event</div>
  </div> -->
  <div class="imagearea">
    <button @click="clearImageSrc">画像のクリア</button>
    <img ref="image" :src="imageSrc" alt="Image" :style="{ display: isImageVisible ? 'block' : 'none', width: '25%' }">
    <span v-show="!isImageVisible">
        <p>No Image</p>
    </span>

    <button @click="clearImage2Src">画像のクリア</button>
    <img ref="image" :src="image2Src" alt="Image" :style="{ display: isImage2Visible ? 'block' : 'none', width: '25%' }">
    <span v-show="!isImage2Visible">
        <p>No Image</p>
    </span>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
<script>
  new Vue({
  el: '#app',
  data: {
    // isActive: '1',
    isActive: true,
    isImageVisible: true,
    isImage2Visible: true,

    imageSrc: '/img/sample.jpg',
    image2Src: '/img/sample2.jpg'

  },
  methods: {
    // isSelect: function (num) {
    //   this.isActive = num;
    // },
    clearImageSrc(){
        // this.$refs.image.src = '';
        this.imageSrc = '';
        this.isImageVisible = false;

    },
    clearImage2Src(){
        // this.$refs.image.src = '';
        this.image2Src = '';
        this.isImage2Visible = false;

    }
  }
})

</script>
</body>
</html>

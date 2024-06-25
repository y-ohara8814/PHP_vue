<!DOCTYPE html>

<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
    <div id=app>

<template>
  <div>
    <ul class="button-group">
      <li
        :class="{ active: selectedOption === 'All' }"
        @click="selectOption('All')"
      >
        All
      </li>
      <li
        :class="{ active: selectedOption === 'PS4' }"
        @click="selectOption('PS4')"
      >
        PS4
      </li>
      <li
        :class="{ active: selectedOption === 'PS5' }"
        @click="selectOption('PS5')"
      >
        PS5
      </li>
      <li
        :class="{ active: selectedOption === 'iOS' }"
        @click="selectOption('iOS')"
      >
        iOS
      </li>
      <li
        :class="{ active: selectedOption === 'Android' }"
        @click="selectOption('Android')"
      >
        Android
      </li>
    </ul>
  </div>
</template>
</div>

<script>
var app = new Vue({
  el: '#app',
  data: {
    selectedOption: 'All'
  },
  methods: {
    selectOption(option) {
      this.selectedOption = option;
    }
  }
})
</script>

<style scoped>
.button-group {
  display: flex;
  flex-wrap: wrap;
  list-style-type: none;
  padding: 0;
}

.button-group li {
  background-color: #ccc;
  border: none;
  color: #333;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button-group li.active {
  background-color: yellow;
}

@media (max-width: 768px) {
  .button-group {
    flex-direction: column;
  }
}
</style>
</body>
</html>

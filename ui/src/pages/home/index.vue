<template>
  <q-page class="row q-py-lg q-px-lg q-gutter-sm">
    <q-card v-for="val in 5" :key="val" class="bg-secondary col storiesCard">
      <img src="https://cdn.quasar.dev/img/mountains.jpg" class="full-height">
    </q-card>
  </q-page>
</template>

<script>
export default {
  name: "Home",
}
</script>

<style scoped>
.storiesCard {
  width: 116.6px;
  height: 198.4px;
  border-radius: 10px;
}
</style>

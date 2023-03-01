<template>
  <v-app>
    <default-bar />
    <default-side />
    <default-view class="limit-width" />
  </v-app>
</template>

<script lang="ts" setup>
import DefaultBar from "./AppBar.vue";
import DefaultView from "./View.vue";
import DefaultSide from "./AppSide.vue";
</script>

<style lang="scss">
.limit-width {
  max-width: calc(100% - 180px);
  width: 100%;
  margin-left: auto;
}
</style>

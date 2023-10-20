<template>
  <div class="flag">
    <img :src="flag" />
  </div>
</template>

<style scoped lang="scss">
.flag {
  display: inline-block;
  overflow: hidden;
  position: relative;
  box-sizing: border-box;

  img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  &::before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    display: block;
    box-sizing: border-box;
  }
}
</style>

<script>
export default {
  props: ["code"],
  computed: {
    flag() {
      return `/img/flags/${this.code}`;
    },
  },
};
</script>

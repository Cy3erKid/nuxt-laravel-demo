<template>
  <b-container>
    <Nuxt />
  </b-container>
</template>
<script>
export default {
  name: 'master',
  mounted() {
    this.$nextTick(() => {
    this.$nuxt.$loading.start();
        setTimeout(() => this.$nuxt.$loading.finish(), 500)
    })
  },
}
</script>
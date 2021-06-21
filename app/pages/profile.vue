<template lang="">
  <b-container>
    <div class="d-block m-auto">
      <b-card>
        <h1>Name: {{ this.$auth.user.name }}</h1>
        <p>Email: {{ this.$auth.user.email }}</p>
      </b-card>
    </div>
  </b-container>
</template>
<script>
export default {
  middleware: ["auth"]
};
</script>
<style lang=""></style>

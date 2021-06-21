<template>
  <b-navbar toggleable="lg" class="topbar">
    <b-navbar-brand tag="div"><b-img-lazy scr="/logo-white.svg" /></b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        
        <nuxt-link to="/" class="nav-link">หน้าแรก</nuxt-link>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown text="Lang" right>
          <b-dropdown-item href="#">EN</b-dropdown-item>
          <b-dropdown-item href="#">TH</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown right v-if="this.$auth.loggedIn">
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <em>User</em>
          </template>
          <li role="presentation"><nuxt-link role="menuitem" to="/profile" class="dropdown-item">Profile</nuxt-link></li>
          <b-dropdown-item href="#" @click="logout">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>

        <nuxt-link to="/login" class="nav-link" v-else>Login</nuxt-link>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>
<script>

export default {
   name: "TopNavbar",
    methods: {
      logout(){
          this.$auth.logout();
      }
    },
};
</script>
<style lang="css">
    .topbar{
        background-color: #0f0e9f;
        color: #fff;
    }
    .navbar-light .navbar-nav .nav-link{
        color: #fff;
    }
    .navbar-nav > .nuxt-link-active{
        color: #fff !important;
    }
    .nuxt-link-active{
        color: #333 !important;
    }

    .nav-link:hover{
        color: #fff !important;
    }
</style>
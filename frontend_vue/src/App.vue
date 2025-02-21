<template>
  <div id="app">
    <nav>
      <router-link to="/"> Home </router-link>
      |
      <router-link to="/about" > About </router-link>
      |
      <router-link to="/contact"> Contact </router-link>
      |
      <router-link to="/WhoAmI"> Who Am I </router-link>
      |
      <router-link to="/blog"> My Blog </router-link>      
      |
      <router-link to="/games"> My Games </router-link>
      
      | <router-link to="/Fullstack" > Fullstack projects </router-link>
    </nav>

    <router-view />

  </div>
</template>

<script>

</script>


<style>
body {
  margin: 0;
  background-color: #fbfbf5;
  color: #000000;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
}

nav {
  padding: 50px;
  background-color: #42b983;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
}

nav a {
  font-weight: bold;
  color: #ffffff;
  text-decoration: none;
  margin: 0 10px;
  font-size: 1.2em;
}

nav a.router-link-exact-active {
  color: #92d9bd;
}

</style>


<template>
  <div>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Desafio</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <div>
                  <router-link to="/listar">
                    <button type="button" class="btn btn-outline-secondary">Tela de Pesquisa</button>  
                  </router-link>
                  <router-link to="/adicionar">
                    <button type="button" class="btn btn-outline-secondary">Tela de Cadastro</button>  
                  </router-link>
                </div>
              </div>
          </div>
        </nav>
    </div>

    <router-view/>
    
  </div>
</template>

<script>

export default {
    created() {

    }
    
}

</script>

<style >
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}

.btn {
    margin: 0 30px;
}

.navbar-brand {
  margin: 0 30px;
}

</style>

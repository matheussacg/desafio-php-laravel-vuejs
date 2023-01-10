import { createRouter, createWebHistory } from 'vue-router'
import ListaView from '../views/ListaView.vue'
import CadastroView from '../views/CadastroView.vue'
import EditView from '../views/EditView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component:ListaView
  },
  {
    path:'/listar',
    name:'listar',
    component:ListaView
  },
  {
    path:'/adicionar',
    name:'adicionar',
    component:CadastroView
  },
  {
    path:'/editar/:id',
    name:'editar',
    component:EditView
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

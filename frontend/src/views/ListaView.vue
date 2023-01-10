<template>

    <div>
        <h1>Listagem e Filtro</h1>
        <router-link to="/adicionar">
            <button type="button" class="btn btn-success mt-3">Novo Registro</button>
        </router-link>

        <div class="container mt-4">
    

                <div class="row">

                    <div class="col-4">
                        <div class="my-3">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome ou CPF" v-model="searchNomeCpf">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="my-3">
                            <input type="text" class="form-control" name="dataInicio" id="dataInicio" placeholder="Data Cadastro Inicio" v-model="searchDataInicio">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="my-3">
                            <input type="text" class="form-control" name="dataFim" id="dataFim" placeholder="Data Cadastro Fim" v-model="searchDataFim">
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-warning" @click="limparFiltro">Limpar Filtro</button>
                    </div>

                </div>
            

        </div>

        <div v-if="excluido" class="alert alert-success mt-4">
            Excluido com sucesso!
        </div>

        <div class="container">
            <table class="table mt-5">
            <thead class="table-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Data Cadastro</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">E-mail</th>
                <th scope="col">Perfil</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in filtrarItems" :key="item.id">
                <th>{{item.id}}</th>
                <td>{{item.created_at}}</td>
                <td>{{item.nome}}</td>
                <td>{{item.cpf}}</td>
                <td>{{item.email }}</td>
                <td>{{item.perfil.tipo}}</td>
                <td>
                    <button @click="getDetalhes(item.id)" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#JanelaModal">Detalhar</button>

                    <div id="JanelaModal" class="modal">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Detalhes do Usuário</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="container">
                                        <table class="table mt-5">
                                            <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Data Cadastro</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">CPF</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col">Perfil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>{{detalhesUsuario.id}}</th>
                                                    <td>{{detalhesUsuario.created_at}}</td>
                                                    <td>{{detalhesUsuario.nome}}</td>
                                                    <td>{{detalhesUsuario.cpf}}</td>
                                                    <td>{{detalhesUsuario.email }}</td>
                                                    <td>{{detalhesUsuario.perfil_id}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="container">
                                        <table class="table mt-5">
                                            <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Logradouro</th>
                                                <th scope="col">CEP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in detalhesUsuario.enderecos" :key="item.id">
                                                    <th>{{item.logradouro}}</th>
                                                    <td>{{item.cep}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <router-link :to="{name:'editar', params:{id:item.id}}">
                        <button type="button" class="btn btn-primary">Editar</button>
                    </router-link>

                    <button @click="excluir(item.id)" type="button" class="btn btn-danger">Excluir</button>  

                </td>
                </tr>
            </tbody>
        </table>
        </div>

    </div>

</template>

<script>

import axios from 'axios'

export default {

    data(){
        return {
            listagem: [],
            detalhesUsuario: [],
            
            perfil: "",

            searchNomeCpf: "",
            searchDataInicio: "",
            searchDataFim: "",

            excluido: false
        }
    },
    methods:{

        limparFiltro(){
            this.searchNomeCpf = "";
            this.searchDataInicio = "";
            this.searchDataFim = "";
        },

        getListagem(){
            axios.get("http://127.0.0.1:8000/api/listar").then((response) => {
                this.listagem = response.data
            });
        },

        excluir($id){
            if(confirm("Deseja realmente excluir esse registro?")){
                axios.delete(`http://127.0.0.1:8000/api/deletar/${$id}`).then((response) => {
                    if(response.data == 'success'){
                        this.excluido = true
                        this.getListagem()
                        this.$router.push('/listar')
                    }  

                });
            }
        },

        getDetalhes($id){
            axios.get(`http://127.0.0.1:8000/api/detalhar/${$id}`).then((response) => {
                this.detalhesUsuario = response.data
            });
        },

        getPerfil($id){
            axios.get(`http://127.0.0.1:8000/api/buscarperfil/${$id}`).then((response) => {
                this.perfil = response.data.tipo
                return this.perfil
            });
        }

    },

    created(){
        this.getListagem()
    },

    computed:{
        filtrarItems(){
        
            let items = [];

            items = this.listagem.filter((item) => {
            return (
            item.nome.toLowerCase().indexOf(this.searchNomeCpf.toLowerCase()) > -1 ||
            item.cpf.toLowerCase().indexOf(this.searchNomeCpf.toLowerCase()) > -1  
            );
        });   
            if((this.searchDataInicio) && (this.searchDataFim)){

                items = items.filter((item)=> {
                let start = new Date(this.searchDataInicio);
                let end   = new Date(this.searchDataFim)
                let date = new Date(item.created_at)
                return ((date >= start) && (date  <= end));
                });
            }
            return items;
        },
        
    },
    
};

</script>

<style>

</style>
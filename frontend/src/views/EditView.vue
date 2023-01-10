<template>

    <div>

        <h1>Editar Usuário</h1>
        
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    
                        <div class="my-3">
                            <label for="nome" class="form-label">Nome: *</label>
                            <input type="text" class="form-control" name="nome" id="nome" v-model="nome">
                        </div>
                        <div class="my-3">
                            <label for="cpf" class="form-label">CPF: *</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" v-model="cpf">
                        </div>
                        <div class="my-3">
                            <label for="email" class="form-label">E-mail: *</label>
                            <input type="email" class="form-control" name="email" id="email" v-model="email">
                        </div>
                        <div class="my-3">
                            <label class="form-label">Perfil: *</label>
                            <select class="form-select" name="tipo" v-model="perfil_id">
                                <option>Selecione</option>
                                <option v-for="item in listagemPerfils" :key="item.id" :value="item.id">{{item.tipo}}</option>
                            </select>
                        </div>

                        <div class="my-3">
                            <label for="logradouro" class="form-label">Logradouro:</label>
                            <input type="text" class="form-control" name="logradouro" id="logradouro" v-model="logradouro">
                        </div>
                        <div class="my-3">
                            <label for="cep" class="form-label">CEP: </label>
                            <input type="text" class="form-control" name="cep" id="cep" v-model="cep">
                        </div>
                        <div class="my-3">
                            <button @click="update" class="btn btn-primary">Salvar</button>
                        </div>
                  
                </div>
                <div class="col-3"></div>
            </div>
            
        </div>

        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <table class="table mt-5">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">Logradouro</th>
                        <th scope="col">CEP</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="endereco in enderecos" :key="endereco.id">
                        <td>{{endereco.logradouro}}</td>
                        <td>{{endereco.cep}}</td>
                        <td>
                            <button type="button" class="btn btn-danger">Excluir</button>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        
    </div>

</template>

<script>

import axios from 'axios'

export default {

    data(){
        return {
            enderecos: [],
            logradouro: '',
            cep: '',

            nome: "",
            cpf: "",
            email: "",
            perfil_id: "",

            listagemPerfils: []

        }
    },
    methods:{

        getListagemPerfils(){
            axios.get("http://127.0.0.1:8000/api/listarperfils").then((response) => {
                    this.listagemPerfils = response.data
            });
        },

        getUsuario(){
            axios.get(`http://127.0.0.1:8000/api/editar/${this.$route.params.id}`).then((response) => {
                    this.nome = response.data.nome
                    this.cpf = response.data.cpf
                    this.email = response.data.email
                    this.perfil_id = response.data.perfil_id
            }); 
        },

        update(){
            var data = {nome:this.nome,cpf:this.cpf,email:this.email,perfil_id:this.perfil_id}
            axios.put(`http://127.0.0.1:8000/api/update/${this.$route.params.id}`, data).then((response) => {
                console.log(response)
            }); 

            setTimeout(() => {
                        this.$router.push('/listar')
                }, 500);

        }

    },

    created(){
        this.getListagemPerfils()
        this.getUsuario()
    }
    
};

</script>

<style>

</style>
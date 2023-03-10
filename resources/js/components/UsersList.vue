<template>
    <div v-if="getToken.type == 1">
        <div class="container">

            <div>
                <div class="row">
                    <div class="col">
                        <p class="my_title">Listado de usuarios</p>
                    </div>

                    <div class="col-3">
                        <div class="form-inline my-2 my-lg-0 input-icons">  
                            <i class="bi bi-search" style="color: grey;"></i>
                            <input style="border-radius: 10px;" class="form-control mr-sm-2 input-field" id="search_user" type="text" v-model="search_user" placeholder="Buscar..." aria-label="Search">
                        </div> 
                    </div>
                </div>

                <router-link to="/create_user" class="btn_new add_button" style="color: black;">
                    Añadir usuario
                </router-link>
                

                
            </div>

            <table class="table_new body_table">
                    <tr>
                        <th style="border-radius: 10px 0 0 0;"><input @click="this.allChecked()" class="form-check-input" type="checkbox" id="all_check" style="margin-left: 0.7rem; border-bottom-width: 0.25px;"></th>
                        <th>Nombre de usuario</th>
                        <th>Email</th>
                        <th style="border-radius: 0 10px 0 0;">Editar</th>
                    </tr>

                    <tbody v-if="search!='not'">
                        <tr v-for="id in search">
                        <td style="border-radius: 10px 0 0 10px;"><input class="form-check-input all_items" type="checkbox" style="margin-left: 0.7rem; border-bottom-width: 0.25px;" v-bind:id="id.id" ></td>
                        <td>
                            <div v-if="id.type == 1">
                                <i class="bi bi-person-fill"></i> {{id.name}}
                            </div>

                            <div v-else>
                                {{id.name}}
                            </div>
                            </td>
                        <td>{{id.email}}</td>
                        <td style="border-radius: 0 10px 10px 0;"><router-link :to="{name: 'edit_user_admin', params: {id: id.id}}"><i class="bi bi-pencil-square"></i></router-link></td>
                    </tr>
                    </tbody>
                    
            
                
            </table>

            <button class="btn_new add_button" data-bs-toggle="modal" data-bs-target="#delete_users">
                Eliminar
            </button>

            <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="delete_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="position: relative;">
                    <div class="modal_content_new">
                        <div class="modal_header_new">
                            <h5 class="modal-title my_title" id="exampleModalLabel">Eliminar usuario(s)</h5>
                        </div>
                        
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="color-card" class="col_form_label_new" style="color:red;">¿Estás seguro de que deseas <span style="color: #731010;">eliminar estos usuarios</span>? No podrás recuperarlos. </label>
                                </div>
                            </form>
                        </div>

                        <div class="row_new">
                            <div class="col-6">
                                <button type="button" class="btn_new button_close" data-bs-dismiss="modal" id="close">Cancelar</button>
                            </div>

                            <div class="col-6">
                                <button @click="this.deleteUsers()" type="button" class="btn_new button_acept">Aceptar </button>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div v-else>
        <h4 class="privilege_error">
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
            Parece ser que no tiene los privilegios necesarios para acceder.
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
        </h4>
    </div>

</template>

<script>
import Axios from 'axios';
export default {
    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user = res.data;

                Axios.get('/all_users')
                    .then((respo) => {
                        this.data_users = respo.data;
                        
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
            },
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return {
            user: [],
            data_users: [],
            search_user: ''
        }
    },

    computed: {
        getToken() {
            return (this.user[0])? this.user[0]: this.user;
        },

        getUsers() {
            return this.data_users;
        },

        search(){
            if(this.search_user){
                var users_search = [];

                for (let i = 0; i < this.getUsers.length; i++) {
                    if(this.getUsers[i].name == this.search_user || this.getUsers[i].name.includes(this.search_user) ){
                        users_search.push(this.getUsers[i]);
                    }                     
                }
                return (users_search.length > 0)? users_search : 'not';

            }else{
                return this.getUsers;
            }
        }
    },

    methods: {
        loadUsersList() {
            Axios.get('/all_users')
                    .then((respo) => {
                        this.data_users = respo.data;

                    },
                    (error) => {
                        console.log(error.response.data);
                    })
        },

        allChecked() {
            if (document.getElementById('all_check').checked) {
                for(let i = 0; i < this.data_users.length; i++) {
                    document.getElementById(this.getUsers[i].id).checked = true;
                }
            } else {
                for(let i = 0; i < this.data_users.length; i++) {
                    document.getElementById(this.getUsers[i].id).checked = false;
                }
            }
            
        },

        deleteUsers() {
            let vm = this;  
        
            let usersDelete = [];

            for(let i = 0; i < this.getUsers.length; i++) {
                if (document.getElementById(this.getUsers[i].id).checked) {
                    usersDelete.push(this.getUsers[i].id);
                    document.getElementById(this.getUsers[i].id).checked = false;
                }

                if (i == this.data_users.length - 1) {
                    Axios.post('/delete_users', 
                        {array: usersDelete})
                    .then(() => {
                        vm.loadUsersList();
                        document.getElementById('all_check').checked = false;
                        document.getElementById('close').click();
                    },
                    (error) => {
                        console.error(error.response.data);
                    })
                }
            }

        },
    }
}
</script>

<style>

</style>
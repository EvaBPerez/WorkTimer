<template>
    <header id="myHeader">
        <div class="row_new">
            <div class="col-3">
                <div v-if="user_token.length != 0">
                    <button id="time" class="btn_new timer_button">
                        <p class="timer">Comenzar <i class="bi bi-stopwatch" style="color: #e69bf0;"></i></p>
                    </button>
                </div>
            </div>

            <div class="col-6">
                <div class="title position-absolute top-40 start-50 translate-middle">
                    <router-link to="/my_proyects">
                        <h1 id="worktimer" >WorkTimer</h1>
                    </router-link>
                </div>
                
            </div>

            <div class="col-3">
                <div v-if="user_token.length == 0">
                    <router-link to="/login" class="button_login" style="color: white;">Iniciar sesión</router-link>
                </div>

                <div v-else-if="user_token.length != 0" class="dropdown">
                    <div class="button_avatar">

                        <div v-if="getToken.type == 1">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img v-bind:src="user_photo" width="40" height="40" alt="asd" class="rounded-circle sombra">
                            </a>

                             <ul class="dropdown-menu" style="font-size: 1.2rem;">
                                <li><router-link to="/setting" class="dropdown-item">Perfil</router-link></li>
                                <li><router-link to="/my_proyects" class="dropdown-item">Mis proyectos</router-link></li>
                                <li><router-link to="/" class="dropdown-item">Usuarios</router-link></li>
                                <li><router-link to="/setting" class="dropdown-item">Historial</router-link></li>
                                <li><router-link to="/setting" class="dropdown-item">Turorial</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item" @click="this.logout()">Cerrar sesión</a></li>
                            </ul>
                        </div>


                        <div v-else-if="getToken.type != 1">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img v-bind:src="user_photo" width="40" height="40" alt="asd" class="rounded-circle sombra">
                            </a>

                            <ul class="dropdown-menu">
                                <li><router-link to="/setting" class="dropdown-item">Perfil</router-link></li>
                                <li><router-link to="/my_proyects" class="dropdown-item">Mis proyectos</router-link></li>
                                <li><router-link to="/setting" class="dropdown-item">Historial</router-link></li>
                                <li><router-link to="/setting" class="dropdown-item">Tutorial</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item" @click="this.logout()">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        

                    </div>

                </div>
                
            </div>
        </div>
            
        
        
    </header>

    <section style="padding-top: 2rem; background-color: #ecf3f4;">
        <router-view></router-view>
        
    </section>

    <foot></foot>
    
    
  
</template>

<script> 
    import Axios from 'axios'
    import foot from './Footer.vue'
    import img_dir from '../img_dir'

export default {
    components: {foot},

    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user_token = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return {
            user_token: [],
            user_photo: img_dir.url + img_dir.avatar_default
        }
    },

    methods: {
        logout() {
            var vm=this;
            Axios.post('/logout').
                then(() => {
                    alert('Se ha cerrado sesión correctamente');
                    vm.user_token=[]; // Ya no existe el usuario
                    window.location.href='/my_proyects'; 
            },
            (error) => {
                console.log(error.response.data);
            });
        }
    },

    computed: {
        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        }
    }

}
</script>

<style>

</style>
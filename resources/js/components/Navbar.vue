<template>
    <header id="myHeader">
        <div class="row_new">
            <div class="col-3">
                <div v-if="user_token.length != 0">
                    <button id="time" class="btn_new timer_button" data-bs-toggle="modal" data-bs-target="#crono">
                        <div v-if="crono_on">
                            <p class="timer" v-html="crono_time"></p>
                        </div>
                        <div v-if="!crono_on">
                            <p class="timer">Comenzar<i class="bi bi-stopwatch" style="color: #e69bf0;"></i></p>
                        </div>
                        
                    </button>
                </div>
            </div>

            <div class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="crono" tabindex="-1" aria-labelledby="cronoModal" aria-hidden="true">
                <div class="modal-dialog" style="position: relative;">
                    <div class="modal_content_new">
                        <div class="modal_header_new">
                            <div v-if="!crono_on">
                                <h5 class="modal-title my_title" id="cronoModal">Comenzar tiempo</h5>
                            </div>
                            <div v-else>
                                <h5 class="modal-title my_title" id="cronoModal">Finalizar tiempo</h5>
                            </div>
                            
                        </div>

                        <div v-if="error">
                            <li style="color: #ad0b0b;"> {{error}}</li>
                        </div>
                        
                        <div v-if="!crono_on">
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="col_form_label_new" for="inputGroupSelect01">Elige el proyecto: </label>

                                        <select class="form-select" style="background-color: rgba(250, 250, 250, 0.59); border-radius: 12px;" 
                                        id="input_proyect" v-on:change="this.searchHomeworks()" v-model="proyect_id">
                                            <option selected value="F">Selecciona alguno</option>
                                            <option v-for="proyect in getProyect"
                                                v-bind:value="proyect.id">{{proyect.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="color-card" class="col_form_label_new">Elige la tarjeta: </label>
                                        <select class="form-select" style="background-color: rgba(250, 250, 250, 0.59); border-radius: 12px;" 
                                        id="input_homework" v-model="homework_id">
                                            <option selected value="F">Selecciona alguno</option>
                                            <option v-for="homework in getHomework"
                                                v-bind:value="homework.id">{{homework.name}}
                                            </option>
                                            
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div v-else>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="col_form_label_new" for="inputGroupSelect01">Elige el proyecto: </label>
                                        <br>
                                        <div class="row" style="text-align: center; font-family: 'Indie Flower', cursive; font-size: 19px;">
                                            <div class="col-4">
                                                <label for="">Productivo</label>
                                                <br>
                                                <div class="star">
                                                    <div v-if="productivity == 1">
                                                        <i style="font-size: 2rem;" class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div v-else>
                                                        <i @click="this.productivityChange(1)" style="font-size: 2rem;" class="bi bi-star"></i>
                                                    </div>                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-4" style="text-align: center;">
                                                <label for="">Normal</label>
                                                <br>
                                                <div class="star">
                                                    <div v-if="productivity == 2">
                                                        <i style="font-size: 2rem;" class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div v-else>
                                                        <i @click="this.productivityChange(2)" style="font-size: 2rem;" class="bi bi-star"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4" style="text-align: center;">
                                                <label for="">Improductivo</label>
                                                <br>
                                                <div class="star">
                                                    <div v-if="productivity == 3">
                                                        <i style="font-size: 2rem;" class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div v-else>
                                                        <i @click="this.productivityChange(3)" style="font-size: 2rem;" class="bi bi-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                        

                        <div class="row_new">
                            <div class="col-6">
                                <button type="button" @click="this.clearInfo()" class="btn_new button_close" data-bs-dismiss="modal" id="close_crono">Cancelar</button>
                            </div>

                            <div class="col-6">
                                <button @click="this.startCrono()" type="button" class="btn_new button_acept">Aceptar</button>
                            </div>
                        </div>
                        
                    </div>
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

                Axios.get(`/all_proyects/${(res.data[0])? 
                        res.data[0].id: res.data.id}`)
                    .then((respo) => {
                        this.proyects = respo.data;
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
            user_token: [],
            user_photo: img_dir.url + img_dir.avatar_default,
            proyects: [], 
            homeworks: [], 
            error: '',
            proyect_id: 'F',
            homework_id: 'F',
            crono_on: false, 
            aceptar_crono: false,
            h: 0,
            m: 0,
            s: 0,
            crono_time: '', 
            total_time: '0 s',
            productivity: null,
            history_id: 0
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
        }, 

        searchHomeworks() {
            let proyect = document.getElementById('input_proyect');
            Axios.get(`/homeworks/${proyect.value}`)
                    .then((respo) => {
                        this.homeworks = respo.data;
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
        }, 

        startCrono() {
            if (!this.crono_on) {
                this.error = '';

                if (this.proyect_id != 'F' && this.homework_id != 'F') {

                    Axios.post('/add_history', 
                        {user_id: this.getToken.id,
                        proyect_id: this.proyect_id,
                        homework_id: this.homework_id, 
                        time: '0 s',
                        productivity: null})
                        .then((res) => {
                            this.history_id = res.data.id;
                            this.crono_on = true;
                            document.getElementById('close_crono').click();
                            this.initCrono();
                        },
                        (error) => {
                            console.log(error.response.data);
                        })
                        
                } else {
                    this.error = 'Debes seleccionar un proyecto y una tarea.'
                }

            } else {
                (this.aceptar_crono) ? this.stopCrono() : this.aceptar_crono = true;
                
            }
            
        }, 

        clearInfo() {
            this.error = '';
            this.proyect_id = 'F';
            this.homework_id = 'F';
            this.aceptar_crono = false;
            this.productivity = null;
        },

        initCrono() {
            this.h = 0;
            this.m = 0;
            this.s = 0;
            this.crono_time="00 : 00 : 00";
            this.updateCrono();
        },

        updateCrono() {
            setTimeout(this.writeCrono, 1000);
        }, 

        writeCrono() {
            let hAux, mAux, sAux;
            this.s++;
            if (this.s > 59) {this.m++; this.s = 0;}
            if (this.m > 59) {this.h++; this.m = 0;}
            if (this.h > 24) {this.h = 0;}

            (this.s < 10)? sAux = "0" + this.s : sAux = this.s;
            (this.m < 10)? mAux = "0" + this.m : mAux = this.m;
            (this.h < 10)? hAux = "0" + this.h : hAux = this.h;

            this.crono_time = hAux + " : " + mAux + " : " + sAux; 

            if (!this.aceptar_crono) {
                this.updateCrono();
            } else {
                if (this.h == 0 && this.m == 0) {
                    this.total_time = this.s + ' s';
                } else if(this.h == 0) {
                    this.total_time = this.m + ' m ' + this.s + ' s ';
                } else {
                    this.total_time = this.h + ' h ' + this.m + ' m ' + this.s + ' s ';
                }

                this.stopCrono();
            }
            
        },

        stopCrono() {
            this.error = '';
            if (this.productivity == null) {
                this.error = 'Debes marcar tu nivel de productividad';
                this.aceptar_crono = false;
                this.updateCrono();

            } else {
                Axios.post('/update_history', {
                    id: this.history_id,
                    time: this.total_time,
                    productivity: this.productivity})
                    .then(() => {
                        document.getElementById('close_crono').click();
                        this.crono_on = false;
                        this.aceptar_crono = false;

                    }, function(error) {
                        console.log(error.response.data);
                    });
            }
        },

        productivityChange(value) {
            this.productivity = value;
        }
    },

    computed: {
        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        },

        getProyect() {
            return this.proyects;
        },

        getHomework() {
            return this.homeworks;
        }
    }

}
</script>

<style>

</style>
<template>
    <header id="myHeader">
        <div class="row_new">
            <div class="col-3">
                <div v-if="user_token.length != 0">
                    <button @click="this.searchProjects()" id="time" class="btn_new timer_button" data-bs-toggle="modal" data-bs-target="#crono">
                        <div v-if="crono_on">
                            <p class="timer" v-html="crono_time"></p>
                        </div>
                        <div v-if="!crono_on">
                            <p class="timer">Comenzar<i class="bi bi-stopwatch" style="color: #e69bf0;"></i></p>
                        </div>
                        
                    </button>
                </div>
            </div>

            <div class="modal fade" style="background-color: rgb(236, 243, 244, 0.562); z-index: 150;" id="crono" tabindex="-1" aria-labelledby="cronoModal" aria-hidden="true" >
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
                                <div v-if="recent_homeworks.length != 0">

                                    <p class="col_form_label_new" >Actividades recientes: </p>

                                    <div class="container_fluid_new" style="margin-bottom: 2rem;">

                                        <div v-for="recentHomework in getRecent">
                                            <button class="btn_new recent_button" @click="this.recentCrono(recentHomework.project_id, recentHomework.homework_id)">
                                                {{recentHomework.project_name}} - {{recentHomework.homework_name}}
                                            </button>
                                        </div>
                                    </div>

                                </div>


                                <form>
                                    <div class="mb-3">
                                        <label class="col_form_label_new" for="input_history">Elige el proyecto: </label>

                                        <select class="form-select" style="background-color: rgba(250, 250, 250, 0.59); border-radius: 12px; font-family: 'Indie Flower', cursive; font-size: 19px;" 
                                        id="input_history" v-on:change="this.searchHomeworks()" v-model="project_id">
                                            <option selected value="F">Selecciona alguno</option>
                                            <option v-for="project in getProject"
                                                v-bind:value="project.id">{{project.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="input_history_homework" class="col_form_label_new">Elige la tarea: </label>
                                        <select class="form-select" style="background-color: rgba(250, 250, 250, 0.59); border-radius: 12px; font-family: 'Indie Flower', cursive; font-size: 19px;" 
                                        id="input_history_homework" v-model="homework_id">
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
                                        <label class="col_form_label_new" for="input_productive">Crees que el tiempo ha sido: </label>
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

                        

                        <div class="row_new" style="margin-top: 2rem;">
                            <div class="col-6">
                                <button type="button" @click="this.clearInfo()" class="btn_new button_close" data-bs-dismiss="modal" id="close_crono">Cancelar</button>
                            </div>

                            <div class="col-6">
                                <button @click="this.startCrono()" type="button" class="btn_new button_acept" data-backdrop="false">Aceptar</button>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>

            <div class="col-6">
                <div class="title position-absolute top-40 start-50 translate-middle">
                    <router-link to="/my_projects">
                        <h1 id="worktimer" >WorkTimer</h1>
                    </router-link>
                </div>
                
            </div>

            <div class="col-3">
                <div v-if="user_token.length == 0">
                    <div class="btn_ new button_login">
                        <router-link to="/login"  style="color: white;">Iniciar sesión</router-link>
                    </div>
                </div>

                <div v-else-if="user_token.length != 0" class="dropdown">
                    <div class="button_avatar">

                        <div v-if="getToken.type == 1">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img v-bind:src="user_photo" width="40" height="40" alt="asd" class="rounded-circle sombra">
                            </a>

                             <ul class="dropdown-menu" style="font-size: 1.2rem;">
                                <li><router-link to="/setting" class="dropdown-item">Perfil</router-link></li>
                                <li><router-link to="/my_projects" class="dropdown-item">Mis projectos</router-link></li>
                                <li><router-link to="/users_list" class="dropdown-item">Usuarios</router-link></li>
                                <li><router-link to="/history" class="dropdown-item">Historial</router-link></li>
                                <li><router-link to="/" class="dropdown-item">Turorial</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><router-link to="/" class="dropdown-item" @click="this.logout()">Cerrar sesión</router-link></li>
                            </ul>
                        </div>


                        <div v-else-if="getToken.type != 1">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img v-bind:src="user_photo" width="40" height="40" alt="asd" class="rounded-circle sombra">
                            </a>

                            <ul class="dropdown-menu" style="font-size: 1.2rem;">
                                <li><router-link to="/setting" class="dropdown-item">Perfil</router-link></li>
                                <li><router-link to="/my_projects" class="dropdown-item">Mis projectos</router-link></li>
                                <li><router-link to="/history" class="dropdown-item">Historial</router-link></li>
                                <li><router-link to="/" class="dropdown-item">Tutorial</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><router-link to="/" class="dropdown-item" @click="this.logout()">Cerrar sesión</router-link></li>
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

    <div style=" margin-top: 8rem;">
        <foot></foot>
    </div>
    
    
    
  
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

                Axios.get(`/crono_on/${(res.data[0])? res.data[0].id : res.data.id}`)
                .then( respo => {
                    if (respo.data.length != 0) {
                        this.crono_on = true;
                        this.history_id = (respo.data[0])? respo.data[0].id : respo.data.id;
                        this.project_id = (respo.data[0])? respo.data[0].project_id : respo.data.project_id;
                        this.homework_id = (respo.data[0])? respo.data[0].homework_id : respo.data.homework_id;
                        this.pending_crono = (respo.data[0])? respo.data[0].created_at : respo.data.created_at;
                        this.writeCrono();
                    }
                });

            },
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return {
            user_token: [],
            user_photo: img_dir.url + img_dir.avatar_default,
            projects: [], 
            homeworks: [], 
            error: '',
            project_id: 'F',
            homework_id: 'F',
            crono_on: false, 
            aceptar_crono: false,
            crono_time: '',
            productivity: null,
            history_id: 0,
            seg: 0,
            pending_crono: "",
            recent_homeworks: []
        }
    },

    methods: {
        logout() {
            var vm=this;
            Axios.post('/logout').
                then(() => {
                    alert('Se ha cerrado sesión correctamente');
                    vm.user_token=[]; // Ya no existe el usuario
                    window.location.href='/my_projects'; 
            },
            (error) => {
                console.log(error.response.data);
            });
        }, 

        searchProjects() {
            Axios.get(`/all_projects/${this.getToken.id}`)
            .then((respo) => {
                this.projects = respo.data;
            },
            (error) => {
                console.log(error.response.data);
            })

            Axios.get(`/recent_homework/${this.getToken.id}`)
                .then( res => {
                    if (res.data.length != 0) {
                        this.recent_homeworks = res.data;
                    }
                },
            (error) => {
                console.log(error.response.data);
            })
        },

        searchHomeworks() {
            let project = document.getElementById('input_history');
            Axios.get(`/all_homeworks/${project.value}`)
                    .then((respo) => {
                        this.homeworks = respo.data;
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
        }, 

        recentCrono(project, homework) {
            this.project_id = project;
            this.homework_id = homework;
            this.startCrono();
        },

        startCrono() {
            if (!this.crono_on) {
                this.error = '';

                if (this.project_id != 'F' && this.homework_id != 'F') {

                    Axios.post('/add_history', 
                        {user_id: this.getToken.id,
                        project_id: this.project_id,
                        homework_id: this.homework_id, 
                        time: 0,
                        productivity: null})
                        .then((res) => {
                            this.history_id = res.data.id;
                            this.crono_on = true;
                            let crono_actual = (res.data[0])? res.data[0].created_at : res.data.created_at;
                            this.pending_crono = crono_actual.replaceAll('T', ' ').substring(0, 19);
                            document.getElementById('close_crono').click();
                            this.initCrono();
                        },
                        (error) => {
                            console.log(error.response.data);
                        })
                        
                } else {
                    this.error = 'Debes seleccionar un projecto y una tarea.'
                }

            } else {
                (this.aceptar_crono) ? this.stopCrono() : this.aceptar_crono = true;
                
            }
            
        }, 

        clearInfo() {
            if(!this.crono_on) {
                this.project_id = 'F';
                this.homework_id = 'F';
            }
            this.error = '';
            this.aceptar_crono = false;
            this.productivity = null;
        },

        initCrono() {
            this.seg = 0;
            this.crono_time="00 : 00 : 00";
            this.updateCrono();
        },

        updateCrono() {
            setTimeout(this.writeCrono, 1000);
        }, 

        writeCrono() {
            let hora_actual = new Date().toISOString().replaceAll('T', ' ').substring(0, 19);
            this.seg = (new Date(hora_actual).getTime() - new Date(this.pending_crono).getTime()) / 1000;
            this.crono_time = this.secondsToString((new Date(hora_actual).getTime() - new Date(this.pending_crono).getTime()) / 1000);


            if (!this.aceptar_crono) {
                this.updateCrono();
            } else {
                this.stopCrono();
            }
            
        },

        secondsToString(seconds) {
            var hour = Math.floor(seconds / 3600);
            hour = (hour < 10)? '0' + hour : hour;
            var minute = Math.floor((seconds / 60) % 60);
            minute = (minute < 10)? '0' + minute : minute;
            var second = seconds % 60;
            second = (second < 10)? '0' + second : second;
            return hour + ' : ' + minute + ' : ' + second;
            
        },

        stopCrono() {
            this.error = '';
            if (this.productivity == null) {
                this.error = 'Debes marcar tu nivel de productividad';
                this.aceptar_crono = false;
                this.updateCrono();

            } else {
                //actualizamos el histórico
                Axios.post('/update_history', {
                    id: this.history_id,
                    time: this.seg,
                    productivity: this.productivity})
                    .then(() => {
                        this.crono_on = false;
                        this.aceptar_crono = false;

                    }, function(error) {
                        console.log(error.response.data);
                    });

                //Actualizamos los datos del projecto
                Axios.get(`/edit/${this.project_id}`)
                    .then((res) => {
                        Axios.post('/update_project', {
                            id: this.project_id, 
                            name: (res.data[0])? res.data[0].name : res.data.name,
                            color: (res.data[0])? res.data[0].color : res.data.color, 
                            time_product: (this.productivity == 1)? ((res.data[0])? res.data[0].time_product + this.seg : res.data.time_product + this.seg) 
                                : (res.data[0])? res.data[0].time_product : res.data.time_product,
                            time_improduct: (this.productivity == 3)? ((res.data[0])? res.data[0].time_improduct + this.seg : res.data.time_improduct + this.seg) 
                                : (res.data[0])? res.data[0].time_improduct : res.data.time_improduct,
                            count: (res.data[0])? res.data[0].count + 1 : res.data.count + 1,
                            total_time: (res.data[0])? res.data[0].total_time + this.seg : res.data.total_time + this.seg,
                        }).then(() => {
                            document.getElementById('close_crono').click();
                            this.project_id = 'F';
                            this.homework_id = 'F';
                            //hacemos que se actualicen las estadísticas
                            
                        }, function(error) {
                            console.log(error.response.data);
                        });
                    
                    }, function (error) {
                        console.log(error.response.data);
                    });


                //Actualizamos los datos de la tarea
                Axios.get(`/edit_h/${this.homework_id}`)
                    .then((res) => {
                        Axios.post('/update_homework', {
                            id: this.homework_id, 
                            name: (res.data[0])? res.data[0].name : res.data.name,
                            color: (res.data[0])? res.data[0].color : res.data.color, 
                            time_product: (this.productivity == 1)? ((res.data[0])? res.data[0].time_product + this.seg : res.data.time_product + this.seg) 
                                : (res.data[0])? res.data[0].time_product : res.data.time_product,
                            time_improduct: (this.productivity == 3)? ((res.data[0])? res.data[0].time_improduct + this.seg : res.data.time_improduct + this.seg) 
                                : (res.data[0])? res.data[0].time_improduct : res.data.time_improduct,
                            count: (res.data[0])? res.data[0].count + 1 : res.data.count + 1,
                            total_time: (res.data[0])? res.data[0].total_time + this.seg : res.data.total_time + this.seg,
                        }).then(() => {
                            document.getElementById('close_crono').click();
                            this.project_id = 'F';
                            this.homework_id = 'F';
                            
                            
                        }, function(error) {
                            console.log(error.response.data);
                        });
                    
                    }, function (error) {
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

        getProject() {
            return this.projects;
        },

        getRecent() {
            return this.recent_homeworks;
        },

        getHomework() {
            return this.homeworks;
        }
    }

}
</script>

<style>

</style>
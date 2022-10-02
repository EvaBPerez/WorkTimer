<template>
  <div style="background-color: #ecf3f4; margin-top: -3rem; height: auto;" >
        <div class="login_card">
            <div style="text-align: center;">
                <h5 class="my_title">{{ title }}</h5>
            </div>

            <div>
                <ul>
                    <li v-if="error" style="color: #ad0b0b;">{{ error }}</li>
                </ul>

                <form @submit="this.acept()">
                    <div v-if="user_rol != null" class="mb-3">
                        <label for="inputRol" class="col_form_label_new">{{user_rol}}</label><br>
                        <select v-model="rol" class="form-select" style="background-color: rgba(250, 250, 250, 0.59); border-radius: 12px; font-family: 'Indie Flower', cursive; font-size: 19px;" 
                            id="rol">
                            <option value="2">Registrado</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div v-if="user_name != null" class="mb-3">
                        <label for="inputName" class="col_form_label_new">{{user_name}} </label>
                        <input type="text" class="form_control_new" v-model="name" id="inputName" placeholder="Escribir aquí..." required pattern="\d+">
                        
                    </div>

                    <div v-if="project_name != null" class="mb-3">
                        <label for="inputProject" class="col_form_label_new">{{project_name}} </label>
                        <input type="text" class="form_control_new" v-model="p_name" id="inputProject" placeholder="Escribir aquí..." required pattern="\d+">
                    </div>

                    <div v-if="input_email != null" class="mb-3">
                        <label for="inputEmail" class="col_form_label_new">{{input_email}} </label>
                        <input type="text" class="form_control_new" v-model="email" id="inputEmail" placeholder="email@example.com" required pattern="\d+">
                    </div>

                    <div v-if="email_enter != null" class="mb-3">
                        <label for="inputEmail" class="col_form_label_new">{{email_enter}} </label>
                        <input type="text" class="form_control_new" v-model="email" id="inputEmail" placeholder="email@example.com" required pattern="\d+">
                    </div>

                    <div v-if="input_old_password != null" class="mb-3">
                        <label for="inputPassword" class="col_form_label_new">{{input_old_password}} </label>
                        <input type="password" class="form_control_new" v-model="old_password" id="inputPassword" placeholder="Escribir aquí..." required pattern="\d+">
                    </div>

                    <div v-if="first_password != null" class="mb-3">
                        <label for="inputPassword" class="col_form_label_new">{{first_password}} </label>
                        <input type="password" class="form_control_new" v-model="password" id="inputPassword" placeholder="Escribir aquí..." required pattern="\d+">
                    </div>

                    <div v-if="second_password != null" class="mb-3">
                        <label for="inputPassword" class="col_form_label_new">{{second_password}} </label>
                        <input type="password" class="form_control_new" v-model="password_second" id="inputPassword" placeholder="Escribir aquí..." required pattern="\d+">
                    </div>

                    <div v-if="color_name != null" class="mb-3">
                        <label for="inputPassword" class="col_form_label_new">{{color_name}} </label>
                        <input type="color" class="form-control form-control-color" v-model="color" id="inputColor" value="white">
                    </div>

                </form>
            </div>

            <div class="row_new">
                <div class="col-6">
                    <div v-if="template_object.title == 'Editar tarea'">
                        <button @click="this.close()" type="button" class="btn_new button_close" style="margin-top: 2rem; color: white;">
                        Cancelar</button>
                    </div>

                    <div v-else-if="template_object.title == 'Editar usuario'">
                        <router-link to="/users_list" type="button" class="btn_new button_close" style="margin-top: 2rem; color: white;">
                        Cancelar</router-link>
                    </div>

                    <div v-else>
                        <router-link to="/my_projects" type="button" class="btn_new button_close" style="margin-top: 2rem; color: white;">
                        Cancelar</router-link>
                    </div>
                    
                </div>

                <div class="col-6">
                    <button @click="this.acept()" type="button" class="btn_new button_acept" style="margin-top: 2rem;">
                    Aceptar</button>
                </div>
            </div>
            
        </div>

        <div v-if="title == 'Iniciar sesión'" class="if_register">
            <p>{{first_subtext}} <router-link to="/signup" style="color: red; text-decoration: underline red;">{{second_subtext}}</router-link></p>
        </div>

        <div v-else-if="title == 'Registrarse'" class="if_register">
            <p>{{first_subtext}} <router-link to="/login" style="color: red; text-decoration: underline red;">{{second_subtext}}</router-link></p>
        </div>

        <div v-else-if="title == 'Mis datos'" class="if_register">
            <p >{{first_subtext}} <span data-bs-toggle="modal" data-bs-target="#delete_user" style="color: red; text-decoration: underline red; cursor: pointer;">{{second_subtext}}</span></p>

            <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="delete_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="position: relative;">
                    <div class="modal_content_new">
                        <div class="modal_header_new">
                            <h5 class="modal-title my_title" id="exampleModalLabel">Eliminar mi cuenta</h5>
                        </div>
                        
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="color-card" class="col_form_label_new" style="color:red;">¿Estás seguro de que deseas eliminar la cuenta? No podrás recuperar los datos. </label>
                                </div>
                            </form>
                        </div>

                        <div class="row_new">
                            <div class="col-6">
                                <button type="button" class="btn_new button_close" data-bs-dismiss="modal" id="close">Cancelar</button>
                            </div>

                            <div class="col-6">
                                <button @click="this.resetUser()" type="button" class="btn_new button_acept">Aceptar </button>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>



            
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';

export default {
    props: ["template_object"],

    beforeCreate() {
        if (this.template_object.title == 'Mis datos') {
            Axios.get('/token')
                .then((res) => {
                    this.user_token = res.data;
                    this.email = (res.data[0])? res.data[0].email : res.data.email;
                    this.name = (res.data[0])? res.data[0].name : res.data.name;
                    this.photo = (res.data[0])? res.data[0].photo : res.data.photo;
                },
                (error) => {
                    console.log(error.response.data);
                })

        } else if (this.template_object.title == 'Editar proyecto') {
            Axios.get(`/edit/${this.template_object.id}`)
            .then(res => {
                this.project_info = (res.data[0])? res.data[0] : res.data;
                this.p_name = (res.data[0])? res.data[0].name : res.data.name;
                this.color = (res.data[0])? res.data[0].color : res.data.color;
            },
            (error) => {
                console.log(error.response.data);
            })

        } else if (this.template_object.title == 'Editar tarea') {
            Axios.get(`/edit_h/${this.template_object.id}`)
                .then(res => {
                    this.homework_info = (res.data[0])? res.data[0] : res.data;
                    this.p_name = (res.data[0])? res.data[0].name : res.data.name;
                    this.color = (res.data[0])? res.data[0].color : res.data.color;
                },
                (error) => {
                    console.log(error.response.data);
                })

        } else if (this.template_object.title == 'Editar usuario') {
            Axios.get(`/user_info/${this.template_object.data_user}`)
                .then(res => {
                    this.data_user = res.data;
                    this.rol = (res.data[0])? res.data[0].type : res.data.type;
                    this.email = (res.data[0])? res.data[0].email : res.data.email;
                    this.name = (res.data[0])? res.data[0].name : res.data.name;
                },
                (error) => {
                    console.log(error.response.data);
                })
        }
    },

    data() {
        return {
            data_user: [],
            title: this.template_object.title,
            user_rol : (this.template_object.user_rol)? this.template_object.user_rol : null,
            user_name: (this.template_object.user_name)? this.template_object.user_name : null,
            input_email : (this.template_object.input_email)? this.template_object.input_email : null,
            email_enter : (this.template_object.email_enter)? this.template_object.email_enter : null,
            input_old_password : (this.template_object.old_password)? this.template_object.old_password : null,
            first_password : (this.template_object.first_password)? this.template_object.first_password : null,
            second_password : (this.template_object.second_password)? this.template_object.second_password : null,
            first_subtext : (this.template_object.first_subtext)? this.template_object.first_subtext : null,
            second_subtext : (this.template_object.second_subtext)? this.template_object.second_subtext : null,
            margin_bottom : (this.template_object.margin_bottom)? this.template_object.margin_bottom : null,
            project_name: (this.template_object.project_name)? this.template_object.project_name : null,
            color_name: (this.template_object.color_name)? this.template_object.color_name : null,
            color: '',
            p_name: '',
            id: (this.template_object.id)? this.template_object.id : null,
            email: '',
            rol: 2,
            name: '',
            old_password: '',
            password: '',
            password_second: '',
            error: '',
            photo: '',
            user_token: [],
            project_info: [],
            homework_info: []
        }
    },

    computed: {
        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        },

        getUser() {
            return (this.data_user[0])? this.data_user[0]: this.data_user;
        },

        getName() {
            return this.p_name;
        }
    },

    methods: {
        close() {
            window.location.href='/homeworks/' + this.homework_info.project_id;
        },

        acept() {
            let vm = this;

            switch(this.title) {
                case 'Iniciar sesión' || 'Crear usuario': 
                    this.error='';
                    Axios.post('/login', {email: this.email, password: this.password}).then((res) => {
                        if(res.data==='ok') {
                            window.location.href='/my_projects';
                        }else{
                            this.error="Error: Usuario y/o contraseña no coincide";
                        }
                        }, function (error) {
                            vm.error="Error: Usuario y/o contraseña no coincide";
                            console.log(error.response.data); 
                        });
                    break;

                case "Registrarse":
                    this.error='';

                    if (this.password != this.password_second) {
                        this.error = 'Las contraseñas no coinciden.'
                    } else {
                        Axios.post('/signup', {
                            name: this.name,
                            email: this.email, 
                            password: this.password,
                            type: this.rol}).then(() => {
                                window.location.href='/my_projects';


                            }, function (error) {
                                vm.error="Error: Falta algún dato o están erróneos";
                                console.log(error.response.data); 
                            });
                    }
                    break;

                case "Crear usuario":
                    this.error='';

                    if (this.password != this.password_second) {
                        this.error = 'Las contraseñas no coinciden.'
                    } else {
                        Axios.post('/create_user', {
                            name: this.name,
                            email: this.email, 
                            password: this.password,
                            type: this.rol}).then(() => {
                                window.location.href='/users_list';


                            }, function (error) {
                                vm.error="Error: Falta algún dato o están erróneos";
                                console.log(error.response.data); 
                            });
                    }

                    
                    break;

                case 'Mis datos':
                    this.error='';

                    if (this.old_password.length != 0 && this.old_password != this.getToken.password) {
                        this.error = 'La antigua contraseña no es correcta.'
                        break;

                    } else if (this.password.length != 0 &&
                                this.password != this.password_second) {
                        this.error = 'Las contraseñas no coinciden.'
                        break;

                    } else if (this.password_second.length != 0 &&
                                this.password != this.password_second) {
                        this.error = 'Las contraseñas no coinciden.'
                        break;

                    } else if (this.password.length != 0) {
                        this.getToken.password = this.password;

                    }
                    
                    Axios.post('/update', {
                        id: this.getToken.id,
                        name: this.name,
                        email: this.email, 
                        password: this.getToken.password,
                        type: this.getToken.type,
                        photo: this.photo}).then(() => {
                            alert('Los datos se han guardado correctamente.')
                            window.location.href='/my_projects';

                        }, function (error) {
                            this.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
                    
                    break;


                case 'Editar usuario':
                    this.error='';
                    let vm = this;
                    
                    Axios.post('/update_admin', {
                        id: vm.getUser.id,
                        name: vm.name,
                        type: vm.rol}).then(() => {
                            alert('Los datos se han guardado correctamente.')
                            window.location.href='/users_list';

                        }, function (error) {
                            vm.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
                    
                    break;


                case 'Editar proyecto':
                    if (this.p_name == '') {
                        alert('El nombre del proyecto está vacío.');
                        break;
                    }
                    vm = this;
                    Axios.post('/update_project', {
                        id: this.id,
                        name: this.p_name,
                        color: this.color,
                        time_improduct: (this.project_info[0])? this.project_info[0].time_improduct : this.project_info.time_improduct,
                        time_product: (this.project_info[0])? this.project_info[0].time_product : this.project_info.time_product,
                        count: (this.project_info[0])? this.project_info[0].count : this.project_info.count, 
                        total_time: (this.project_info[0])? this.project_info[0].total_time : this.project_info.total_time
                        }).then(() => {
                            window.location.href='/my_projects';

                        }, function (error) {
                            vm.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
                    break;

                case 'Editar tarea':
                    if (this.p_name == '') {
                        alert('El nombre de la tarea está vacío.');
                        break;
                    }
                    vm = this;
                    Axios.post('/update_homework', {
                        id: this.id,
                        name: this.p_name,
                        color: this.color,
                        time_improduct: (this.homework_info[0])? this.homework_info[0].time_improduct : this.homework_info.time_improduct,
                        time_product: (this.homework_info[0])? this.homework_info[0].time_product : this.homework_info.time_product,
                        count: (this.homework_info[0])? this.homework_info[0].count : this.homework_info.count, 
                        total_time: (this.homework_info[0])? this.homework_info[0].total_time : this.homework_info.total_time
                        }).then(() => {
                            window.location.href='/homeworks/' + this.homework_info.project_id;

                        }, function (error) {
                            vm.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
                    break;
            }
        },

        resetUser() {
            Axios.post('/delete_user', {
                        id: this.getToken.id,
                        name: this.name,
                        email: this.email, 
                        password: this.getToken.password,
                        type: this.getToken.type,
                        photo: this.photo}).then(() => {
                            alert('La cuenta ha sido eliminada correctamente.')
                            window.location.href='/';

                        }, function (error) {
                            this.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
        }
    }
}
</script>

<style>

</style>
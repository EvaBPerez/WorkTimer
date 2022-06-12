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
                        <label>{{user_rol}}</label><br>
                        <select v-model="rol" id="rol">
                            <option value="2">Registrado</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div v-if="user_name != null" class="mb-3">
                        <label for="inputName" class="col_form_label_new">{{user_name}} </label>
                        <input type="text" class="form_control_new" v-model="name" id="inputName" placeholder="Escribir aquí..." required pattern="\d+">
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

                </form>
            </div>

            <div class="row_new">
                <div class="col-6">
                    <router-link to="/my_proyects" type="button" class="btn_new button_close" style="margin-top: 2rem; color: white;">
                        Cancelar</router-link>
                </div>

                <div class="col-6">
                    <button @click="this.acept()" type="button" class="btn_new button_acept" style="margin-top: 2rem;">
                    Aceptar</button>
                </div>
            </div>
            
        </div>

        <div v-if="title == 'Iniciar sesión'" class="if_register">
            <p style="font-weight: bold;">{{first_subtext}} <router-link to="/singup" style="color: red; text-decoration: underline red;">{{second_subtext}}</router-link></p>
        </div>

        <div v-else-if="title == 'Registrarse'" class="if_register">
            <p style="font-weight: bold;">{{first_subtext}} <router-link to="/login" style="color: red; text-decoration: underline red;">{{second_subtext}}</router-link></p>
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
        }
    },

    data() {
        return {
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
            email: '',
            rol: 2,
            name: '',
            old_password: '',
            password: '',
            password_second: '',
            error: '',
            photo: '',
            user_token: []
        }
    },

    computed: {
        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        }
    },

    methods: {
        acept() {
            let vm = this;

            switch(this.title) {
                case 'Iniciar sesión' || 'Crear usuario': 
                    this.error='';
                    console.log(this.email);
                    console.log(this.password);
                    Axios.post('/login', {email: this.email, password: this.password}).then((res) => {
                        if(res.data==='ok') {
                            window.location.href='/my_proyects';
                        }else{
                            this.error="Error: Usuario y/o contraseña no coincide";
                        }
                        }, function (error) {
                            vm.error="Error: Usuario y/o contraseña no coincide";
                            console.log(error.response.data); 
                        });
                    break;

                case 'Registrarse':
                    this.error='';

                    if (this.password != this.password_second) {
                        this.error = 'Las contraseñas no coinciden.'
                    } else {
                        Axios.post('/signup', {
                            name: this.name,
                            email: this.email, 
                            password: this.password,
                            type: this.rol}).then(() => {
                                window.location.href='/my_proyects';

                            }, function (error) {
                                vm.error="Error: Falta algún dato o están erróneos";
                                console.log(error.response.data); 
                            });
                    }

                    
                    break;

                case 'Mis datos' || 'Editar usuario':
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
                            window.location.href='/my_proyects';

                        }, function (error) {
                            vm.error="Error: Falta algún dato o están erróneos";
                            console.log(error.response.data); 
                        });
                    
                    break;
            }
        }
    }
}
</script>

<style>

</style>

<template>
<div id="proyect_animation">

    <div class="card_new" v-bind:id="id_proyect" 
    
        v-bind:style="{ 'background-color': getColor }" aria-disabled="true">
        <img src="../../../public/images/broke.png" class="oculta" id="roto">
        <div class="card-body">
            <div class="row_new">
                <div class="col-10">
                    <h5 class="card-title" style="font-family: 'Lemonada', cursive;">{{name}}</h5>
                </div>
                <div class="col-2 three_dots">
                    

                    <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" style="font-family: 'Indie Flower', cursive; font-size: 1.2rem; text-align: center;">
                        <li><router-link :to="{name: 'edit_proyect', params: {ids: this.id}}" class="dropdown-item">
                            Editar
                        </router-link></li>
                        <li><hr class="dropdown-divider" style="margin-left: 1.5rem; margin-right: 1.5rem;"></li>
                        <li @click="this.deleteProyect()"><router-link to="" class="dropdown-item" id="delete">Eliminar</router-link></li>
                        <DeleteVue></DeleteVue>
                    </ul>

                </div>
            </div>

            

            <div class="row_new"> 
                <div class="col-6">
                    <span style="font-family: 'Indie Flower', cursive; font-size: 22px;">{{total_time}}</span>
                </div>

                <div class="col-6" style="text-align: right;">
                    <span style="font-family: 'Indie Flower', cursive; font-size: 22px;">{{percen}}</span>
                </div>

            </div>
            
            <br>
            <router-link :to="{name: 'proyect_analitic', params: {id: this.proyect.id}}"
                class="button_card">
                <span style="text-decoration: none; color: black;">Ver más</span>
            </router-link>
        </div>

    </div>
</div>

    
    

</template>

<script>
    import DeleteVue from './Delete.vue';
    import Axios from 'axios';
    import Edit from './EditProyect.vue';

export default {
    props: ["proyect"],    

    components:{ Edit, DeleteVue},

    data() {
        return {
            id: this.proyect.id,
            name: this.proyect.name,
            color: this.proyect.color,
            value_color: this.proyect.color,
            value_name: this.proyect.name,
            show_modal: true,
            edi: false,
            id_proyect: 'proyect' + this.proyect.id,
            time_aux: 0,
            total_time: this.secondsToString(this.proyect.total_time),
            percen: (this.proyect.time_product != 0)? Math.round(this.proyect.time_product * 100 / this.proyect.total_time) + " %" : "0 %"
        }
    },

    watch:{
        proyect(val){
            this.id = val.id;
            this.name = val.name;
            this.color = val.color; 
            this.value_color = val.color;
            this.value_name = val.name;
        }, 

        percen: function(val) {
            this.percen = val;
        },

        total_time: function(val) {
            this.total_time = val;
        }

    },

    computed: {
        getColor() {
            return this.color;
        },

        getId() {
            return this.id;
        }
    },

    methods: {
        deleteProyect() {
            Axios.get(`/delete/${this.getId}`)
                .then(() => {
                    this.$emit("loadProyect"); // emitimos un evento que recoge el componente padre "MyProyects"
                },
                (error) => {
                    console.error(error.response.data);
                })
        },

        secondsToString(seconds) {
            var hour = Math.floor(seconds / 3600);
            hour = (hour < 10)? '0' + hour : hour;
            var minute = Math.floor((seconds / 60) % 60);
            minute = (minute < 10)? '0' + minute : minute;
            var second = seconds % 60;
            second = (second < 10)? '0' + second : second;

            if (hour != 0) {
                return hour + ' h ' + minute + ' m ' + second + " s";

            } else if(minute != 0) {
                
                return minute + ' m ' + second + " s";
            } else {
                return second + " s";
            }
            
        }
    }

}

</script>

<style>
    .three_dots {
        text-align: right;
        margin-top: 2%;
    }

    .oculta {
        display: none;
        position: absolute;
        width: 15rem;
        height: auto;
    }
</style>
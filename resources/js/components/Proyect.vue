<template>
<div id="proyect_animation">


    <div class="card_new" id="proyect" 
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
                        <li><router-link :to="{name: 'edit', params: {ids: this.id}}" class="dropdown-item">
                            Editar
                        </router-link></li>
                        <li><hr class="dropdown-divider" style="margin-left: 1.5rem; margin-right: 1.5rem;"></li>
                        <li @click="this.mostrar()"><router-link to="/delete" class="dropdown-item" >Eliminar</router-link></li>
                    </ul>

                </div>
            </div>
            
            <br><br>
            <router-link :to="{name: 'homeworks', params: {id: this.proyect.id}}"
                class="button_card">
                <span style="text-decoration: none; color: black;">Ver más</span>
            </router-link>
        </div>

    </div>
</div>

    
    

</template>

<script>
import Axios from 'axios';
    import Edit from './Edit.vue';

export default {

    components:{Edit},

    props: ["proyect"],

    data() {
        return {
            id: this.proyect.id,
            name: this.proyect.name,
            color: this.proyect.color,
            value_color: this.proyect.color,
            value_name: this.proyect.name,
            show_modal: true,
            edi: false
        }
    },

    watch:{
        proyect(val){
            this.name = val.name;
            this.color = val.color; 
            this.value_color = val.color;
            this.value_name = val.name;
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
        mostrar() {
            Axios.get(`/delete/${this.id}`)
                .then(() => {
                },
                (error) => {
                    console.error(error.response.data);
                })
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
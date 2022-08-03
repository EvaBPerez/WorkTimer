<template>
    <div class="card_new" v-bind:id="id_homework" 
    
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
                        <li><router-link :to="{name: 'edit_homework', params: {ids: this.homework.id}}" class="dropdown-item">
                            Editar
                        </router-link></li>
                        <li><hr class="dropdown-divider" style="margin-left: 1.5rem; margin-right: 1.5rem;"></li>
                        <li @click="this.mostrar()"><router-link to="" class="dropdown-item" id="delete">Eliminar</router-link></li>
                        <DeleteVue></DeleteVue>
                    </ul>

                </div>
            </div>
            
            <br><br>
            <router-link :to="{name: 'homework_analitic', params: {id: this.homework.id}}"
                class="button_card">
                <span style="text-decoration: none; color: black;">Ver más</span>
            </router-link>
        </div>

    </div>

</template>

<script>
import Axios from 'axios';
export default {
    props: ["homework"],

    data() {
        return {
            id: this.homework.id,
            name: this.homework.name,
            color: this.homework.color,
            id_homework: 'homework' + this.homework.id,
        }
    },

    watch:{
        homework(val){
            this.id = val.id;
            this.name = val.name;
            this.color = val.color;    
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
            Axios.get(`/delete_h/${this.getId}`)
                .then(() => {
                    this.$emit("loadHomework"); // emitimos un evento que recoge el componente padre "MyProyects
                },
                (error) => {
                    console.error(error.response.data);
                })

            
            
            // window.setTimeout(this.deleteProyect, 1500);
        },

    }
}
</script>

<style>

</style>
<template>
    
    <div class="card_new" id="proyect" 
        v-bind:style="{ 'background-color': getColor }">
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
                        <li><a class="dropdown-item" href="#">Editar</a></li>
                        <li><hr class="dropdown-divider" style="margin-left: 1.5rem; margin-right: 1.5rem;"></li>
                        <li><a class="dropdown-item" href="#">Eliminar</a></li>
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

</template>

<script>

export default {
    props: ["proyect"],

    data() {
        return {
            name: this.proyect.name,
            color: this.proyect.color
        }
    },

    watch:{
        proyect(val){
            this.name = val.name;
            this.color = val.color;     
        }
    },

    computed: {
        getColor() {
            return this.color;
        }
    }

}

</script>

<style>
    .three_dots {
        text-align: right;
        margin-top: 2%;
    }
</style>
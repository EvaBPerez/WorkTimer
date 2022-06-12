<template>
  <div class="card_new" 
        v-bind:style="{ 'background-color': getColor }">
        <div class="card-body">
            <div class="row_new">
                <div class="col-10">
                    <h5 class="card-title">{{name}}</h5>
                </div>
                <div class="col-2 three_dots">
                    <i class="bi bi-three-dots-vertical"
                    id="navbarDropdownMenuLink" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false"></i>
                     <ul class="prueba dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>

                </div>
            </div>
            
            <br><br>
            <router-link to="/my_proyects"
                class="button_card">
                <span style="text-decoration: none; color: black;">Ver más</span>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    props: ["homework"],

    data() {
        return {
            name: this.homework.name,
            color: this.homework.color
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

</style>
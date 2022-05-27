<template>
    <div class="container">
        <p class="my_title">Mis proyectos</p>
        <button class="add_button" data-bs-toggle="modal" data-bs-target="#add_proyect">
            Añadir proyecto
        </button>
    </div>

    <div class="modal fade" style="background-color: rgba(254, 239, 255, 0.562);" id="add_proyect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="position: relative;">
            <div class="modal_content_new">
                <div class="modal_header_new">
                    <h5 class="modal-title my_title" id="exampleModalLabel">Nuevo proyecto</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col_form_label_new">Nombre del proyecto: </label>
                            <input type="text" class="form_control_new" v-model="name" id="recipient-name" placeholder="Escribir aquí..." required pattern="\d+">
                        </div>
                        <div class="mb-3">
                            <label for="color-card" class="col_form_label_new">Color de la tarjeta: </label>
                            <input type="color" class="form-control form-control-color" v-model="color" id="exampleColorInput" value="#ffffff">
                        </div>
                    </form>
                </div>

                <div class="row_new">
                    <div class="col-6">
                        <button type="button" class="btn_new button_close" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="col-6">
                        <button @click="this.addProyect()" type="button" class="btn_new button_acept">Añadir</button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <div class="container_fluid_new">
        <div v-for="id in getIds" :proyect="id">
            <proyect :proyect.sync="id"></proyect>
        </div>
    </div>

  
</template>

<script>
import Axios from 'axios'
    import proyect from './Proyect.vue'

export default {
    components: {proyect},

    beforeCreate() {
        Axios.get('/all_proyects')
            .then(res => {
                this.ids = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })
    }, 

    data() {
        return {
            name: "", 
            color: "#ffffff",
            ids: []
        }
    }, 

    computed: {
        getIds() {
            return this.ids;
        }
    }, 

    methods: {
        addProyect() {
            if (!this.name) {
                alert('No puedes dejar el nombre en blanco');
            } else {
                Axios.post('/add_proyect', {name: this.name, color: this.color, user_id: 1})
                    .then(() => {
                        alert('se he guardado correctamente');
                        window.location.href='/my_proyects';
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
            }
            
        }
    }

}
</script>

<style>

    .content {
        margin: 5%;
        margin-top: 2%;
        color: #ffffff;
    }

</style>
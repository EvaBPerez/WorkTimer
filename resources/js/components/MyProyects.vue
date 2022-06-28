<template>
    <div class="container">
        <p class="my_title">Mis proyectos</p>
        <button class="btn_new add_button" data-bs-toggle="modal" data-bs-target="#add_proyect">
            Añadir proyecto
        </button>
    </div>

    <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="add_proyect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn_new button_close" data-bs-dismiss="modal" id="close">Cancelar</button>
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
            <proyect @loadProyect="loadProyect" :proyect.sync="id"></proyect>  
            <!-- el @loadProyect="loadProyect" es para recibir el evento del componete hijo "proyect"-->
        </div>
    </div>

  
</template>

<script>
    import Axios from 'axios'
    import proyect from './Proyect.vue'

export default {
    components: {proyect},

    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user_token = res.data;

                Axios.get(`/all_proyects/${(res.data[0])? 
                        res.data[0].id: res.data.id}`)
                    .then((respo) => {
                        this.ids = respo.data;
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
            name: "", 
            color: "#ffffff",
            ids: [],
            user_token: [],
            aux: 0,
            show_modal: false
        }
    }, 

    computed: {
        getIds() {
            return this.ids;
        },

        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        }
    }, 

    methods: {
        addProyect() {
            if (!this.name) {
                alert('No puedes dejar el nombre en blanco');
            } else {
                Axios.post('/add_proyect', {name: this.name, 
                color: this.color, 
                user_id: this.getToken.id, 
                count: 0,
                time_improduct: 0,
                time_normal: 0, 
                time_product: 0,
                total_time: 0})
                    .then(() => {
                        alert('se he guardado correctamente');
                        this.name = '';
                        this.color = "#ffffff";
                        this.loadProyect();
                        document.getElementById('close').click();
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
            }
            
        },

        loadProyect() {
            Axios.get(`/all_proyects/${this.getToken.id}`)
                .then((respo) => {
                    this.ids = respo.data;
              },
                (error) => {
                    console.log(error.response.data);
                })
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
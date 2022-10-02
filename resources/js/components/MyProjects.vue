<template>
    <div class="container">
        <p class="my_title">Mis proyectos</p>
        

        <div class="row">
            <div class="col">
                <button class="btn_new add_button" data-bs-toggle="modal" data-bs-target="#add_project">
                    Añadir proyecto
                </button>
            </div>

            <div class="col-3">
                <div class="form-inline my-2 my-lg-0 input-icons">  
                    <i class="bi bi-search" style="color: grey;"></i>
                    <input style="border-radius: 10px;" class="form-control mr-sm-2 input-field" id="search_project" type="text" v-model="search_project" placeholder="Buscar..." aria-label="Search">
                </div> 
            </div>
        </div>
    </div>

    <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="add_project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button @click="this.addProject()" type="button" class="btn_new button_acept">Añadir</button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <div class="container_fluid_new" v-if="search!='not'">
        <div v-for="id in search" :project="id">
            <project @loadproject="loadProject" :project.sync="id"></project>  
            <!-- el @loadproject="loadproject" es para recibir el evento del componete hijo "project"-->
        </div>
    </div>

  
</template>

<script>
    import Axios from 'axios'
    import project from './project.vue'

export default {
    components: {project},

    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user_token = res.data;

                Axios.get(`/all_projects/${(res.data[0])? 
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
            show_modal: false,
            search_project: ''
        }
    }, 

    computed: {
        getIds() {
            return this.ids;
        },

        getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        },

        search(){
            if(this.search_project){
                var project_search = [];

                for (let i = 0; i < this.getIds.length; i++) {
                    if(this.getIds[i].name == this.search_project || this.getIds[i].name.includes(this.search_project) ){
                        project_search.push(this.getIds[i]);
                    }                     
                }
                
                return (project_search.length > 0)? project_search : 'not';

            }else{
                return this.getIds;
            }
        }
    }, 

    methods: {
        addProject() {
            if (!this.name) {
                alert('No puedes dejar el nombre en blanco');
            } else {
                Axios.post('/add_project', {name: this.name, 
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
                        this.loadProject();
                        document.getElementById('close').click();
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
            }
            
        },

        loadProject() {
            Axios.get(`/all_projects/${this.getToken.id}`)
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
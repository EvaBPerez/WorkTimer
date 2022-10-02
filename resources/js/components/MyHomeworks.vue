<template>

    <div class="container">
        <p class="my_title">Mis Tareas: {{project.name}}</p>

        <div class="row">
            <div class="col">
                <button class="btn_new add_button" data-bs-toggle="modal" data-bs-target="#add_homework">
                    Añadir tarea
                </button>
            </div>

            <div class="col-3">
                <div class="form-inline my-2 my-lg-0 input-icons">  
                    <i class="bi bi-search" style="color: grey;"></i>
                    <input style="border-radius: 10px;" class="form-control mr-sm-2 input-field" id="search_homework" type="text" v-model="search_homework" placeholder="Buscar..." aria-label="Search">
                </div> 
            </div>
        </div>
    </div>



    <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="add_homework" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="position: relative;">
            <div class="modal_content_new">
                <div class="modal_header_new">
                    <h5 class="modal-title my_title" id="exampleModalLabel">Nueva tarea</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col_form_label_new">Nombre de la tarea: </label>
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
                        <button @click="this.addHomework()" type="button" class="btn_new button_acept">Añadir</button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>


    <div class="container_fluid_new" v-if="search!='not'">
        <div v-for="id in search" :homework="id">
            <homework @loadHomework="loadHomework" :homework.sync="id"></homework>
        </div>
    </div>
</template>

<script>
import homework from './Homework.vue'
import Axios from 'axios';

export default {
    components: {homework},

    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user_token = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })

        Axios.get(`/all_homeworks/${this.id}`)
            .then(res => {
                this.id_homeworks = res.data;
            },
            (error) => {
                console.log(error.response.data);
            });

        Axios.get(`/edit/${this.id}`)
            .then(res => {
                this.project = (res.data[0])? res.data[0] : res.data;
            },
            (error) => {
                console.log(error.response.data);
            });
    },

    props: ["id"],

    data() {
        return {
            id_homeworks: [],
            project: [],
            show_modal: false,
            name: '',
            color: "#ffffff",
            aux: 0,
            user_token: [],
            search_homework: ''
        }
    }, 

    computed: {
        getIds() {
            return this.id_homeworks;
        },

         getToken() {
            return (this.user_token[0])? this.user_token[0]: this.user_token;
        },

        search(){
            if(this.search_homework){
                var homework_search = [];

                for (let i = 0; i < this.getIds.length; i++) {
                    if(this.getIds[i].name == this.search_homework || this.getIds[i].name.includes(this.search_homework) ){
                        homework_search.push(this.getIds[i]);
                    }                     
                }
                return (homework_search.length > 0)? homework_search : 'not';

            }else{
                return this.getIds;
            }
        }
    },

    methods: {
        addHomework() {
            if (!this.name) {
                alert('No puedes dejar el nombre en blanco');
            } else {
                Axios.post('/add_homework', {name: this.name, 
                color: this.color, 
                user_id: this.getToken.id, 
                project_id: this.id,
                count: 0,
                time_improduct: 0,
                time_normal: 0, 
                time_product: 0,
                total_time: 0})
                    .then(() => {
                        alert('se he guardado correctamente');
                        this.name = '';
                        this.color = "#ffffff";
                        this.loadHomework();
                        document.getElementById('close').click();
                    },
                    (error) => {
                        console.log(error.response.data);
                    })
            }
            
        },

        loadHomework() {
            Axios.get(`/all_homeworks/${this.project.id}`)
                .then((respo) => {
                    this.id_homeworks = respo.data;
              },
                (error) => {
                    console.log(error.response.data);
                })
        }
    }
}
</script>

<style>

</style>
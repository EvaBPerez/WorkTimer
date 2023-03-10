<template>
    <div v-if="getToken.length != 0">
        <div class="container">

            <div>
                
                <div class="row">
                    <div class="col">
                        <p class="my_title">Historial de tiempos</p>
                    </div>

                    <div class="col-3">
                        <div class="my-2 my-lg-0 input-icons">  
                            <i class="bi bi-calendar"></i>
                            <input style="border-radius: 10px;" class="form-control mr-sm-2 input-field" id="search_history" type="date" v-model="search_history" placeholder="Buscar..." aria-label="Search">
                        </div> 
                    </div>
                </div>
            </div>

            <table class="table_new">
                    <tr>
                        <th style="border-radius: 10px 0 0 0;"><input @click="this.allChecked()" class="form-check-input" type="checkbox" id="all_check" style="margin-left: 0.7rem; border-bottom-width: 0.25px;"></th>
                        <th>Fecha y hora</th>
                        <th>Tiempo</th>
                        <th>Nombre del proyecto</th>
                        <th style="border-radius: 0 10px 0 0;">Nombre de la tarea</th>
                    </tr>

                <tbody v-if="search!='not'">
                    <tr v-for="id in search">
                        <td style="border-radius: 10px 0 0 10px;"><input class="form-check-input all_items" type="checkbox" style="margin-left: 0.7rem; border-bottom-width: 0.25px;" v-bind:id="id.id" ></td>
                        <td>{{this.formatTime(id.created_at)}}</td>
                        <td>{{this.secondsToString(id.time)}}</td>
                        <td>{{id.project_name}}</td>
                        <td style="border-radius: 0 10px 10px 0;">{{id.homework_name}}</td>
                    </tr>
                </tbody>
                
            </table>

            <button class="btn_new add_button" data-bs-toggle="modal" data-bs-target="#delete_history">
                Eliminar
            </button>

            <div v-show="show_modal" class="modal fade" style="background-color: rgb(236, 243, 244, 0.562);" id="delete_history" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="position: relative;">
                    <div class="modal_content_new">
                        <div class="modal_header_new">
                            <h5 class="modal-title my_title" id="exampleModalLabel">Eliminar historial</h5>
                        </div>
                        
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="color-card" class="col_form_label_new" style="color:red;">¿Estás seguro de que deseas <span style="color: #731010;">eliminar estos datos del historial</span>? No podrás recuperarlos y las estadísticas cambiarán. </label>
                                </div>
                            </form>
                        </div>

                        <div class="row_new">
                            <div class="col-6">
                                <button type="button" class="btn_new button_close" data-bs-dismiss="modal" id="close">Cancelar</button>
                            </div>

                            <div class="col-6">
                                <button @click="this.deleteHistory()" type="button" class="btn_new button_acept">Aceptar </button>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div v-else>
        <h4 class="privilege_error">
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
            Parece ser que no tiene los privilegios necesarios para acceder.
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
        </h4>
    </div>
    


</template>

<script>
    import Axios from 'axios'

export default {
    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user = res.data;

                Axios.get(`/all_history/${(res.data[0])? res.data[0].id: res.data.id}`)
                    .then((respo) => {
                        this.data_history = respo.data;
                        
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
            user: [],
            data_history: [],
            search_history: ''
        }
    },

    computed: {
        getToken() {
            return (this.user[0])? this.user[0]: this.user;
        },

        getHistory() {
            return this.data_history;
        },

        search(){
            if(this.search_history){
                
                var history_search = [];

                for (let i = 0; i < this.getHistory.length; i++) {
                    if(this.getHistory[i].created_at.substring(0, 10) == this.search_history){
                        history_search.push(this.getHistory[i]);
                    }                     
                }
                return (history_search.length > 0)? history_search : 'not';

            }else{
                return this.getHistory;
            }
        }
    },

    methods: {
        formatTime(date) {
            let year = date.substring(0, 4);
            let month = date.substring(5, 7);
            let day = date.substring(8, 10);
            let hour = date.substring(11, 16);
            return day + "/" + month + "/" + year + " - " + hour
        },

        deleteHistory() {
            let vm = this;  
        
            let historyDelete = [];

            for(let i = 0; i < this.getHistory.length; i++) {
                if (document.getElementById(this.getHistory[i].id).checked) {
                    historyDelete.push(this.getHistory[i].id);
                    document.getElementById(this.getHistory[i].id).checked = false;
                }

                if (i == this.data_history.length - 1) {
                    Axios.post('/delete_hy', 
                        {array: historyDelete})
                    .then(() => {
                        vm.loadHistory();
                        document.getElementById('all_check').checked = false;
                        document.getElementById('close').click();
                    },
                    (error) => {
                        console.error(error.response.data);
                    })
                }
            }

        },

        loadHistory() {
            Axios.get(`/all_history/${this.getToken.id}`)
                    .then((respo) => {
                        this.data_history = respo.data;

                    },
                    (error) => {
                        console.log(error.response.data);
                    })
        },

        allChecked() {
            if (document.getElementById('all_check').checked) {
                for(let i = 0; i < this.data_history.length; i++) {
                    document.getElementById(this.getHistory[i].id).checked = true;
                }
            } else {
                for(let i = 0; i < this.data_history.length; i++) {
                    document.getElementById(this.getHistory[i].id).checked = false;
                }
            }
            
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

</style>
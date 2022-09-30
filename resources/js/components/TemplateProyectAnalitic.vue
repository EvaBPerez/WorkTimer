<template>

    <div class="container_fluid_new">
        <div v-for="card of index">
            <div class="card_new" >
                <div class="card-body">
                    <div class="row_new">
                        <div class="col-10" style="height: 1.5rem;">
                            <h5 class="card-title" style="font-family: 'Lemonada', cursive; font-weight: bold;">{{card.title}}</h5>
                        </div>

                        <div class="col-2">
                            <img_info_analitic>
                                <i class="bi bi-info-circle"></i>
                                <info_analitic>{{card.help}}</info_analitic>
                            </img_info_analitic>
                        </div>
                    </div>
                    
                    <br><br>
                    <p class="num_analitic">{{card.time}}</p>
                </div>

            </div>
        </div>
    </div>

    <div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    
</template>

<script>
    import Axios from 'axios';
    import Chart from "chart.js/auto";
    

export default {

    beforeMount() {
        this.reloadProyect();

        Axios.get(`/graphic_day/${this.proyect.id}`)
        .then(respo => {
            console.log(respo.data[0]);
            respo.data.forEach(element => {
                this.stock.push(parseInt(element.time));
            })

            this.selectDay();  
            },
            (error) => {
                console.log(error.response.data);
            })

    },

    mounted() { 
        console.log(this.stock);
        
    },

    props: ['proyect'],

    data() {
        return {
            index: [
                {title: 'Tiempo total',
                time: '0 s',
                help: 'Tiempo total dedicado al proyecto'},

                {title: 'Tiempo productivo',
                time: '0 %',
                help: 'Porcentaje del tiempo productivo dedicado al proyecto'},

                {title: 'Tiempo promedio',
                time: '0 s',
                help: 'Tiempo promedio por estudio'},

                {title: 'Tiempo improductivo',
                time: '0 %',
                help: 'Porcentaje del tiempo improductivo dedicado al proyecto'}
                ],

            legend: [],
            stock: []
        }
    },

    methods: {
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
            
        },

        reloadProyect() {
            if (this.proyect.count != 0) {
                this.index[0].time = this.secondsToString(this.proyect.total_time);
                this.index[1].time = Math.round(this.proyect.time_product * 100 / this.proyect.total_time) + " %";
                this.index[2].time = this.secondsToString(Math.round(this.proyect.total_time/ this.proyect.count));
                this.index[3].time = Math.round(this.proyect.time_improduct * 100 / this.proyect.total_time) + " %";
            }
        }, 

        selectDay() {
            

            this.loadGraphic();
        }, 

        loadGraphic() {
            var myChart = new Chart(document.querySelector("#myChart"), {
                type: 'bar', 
                data: {
                    labels: ['L', 'M', 'X', 'J', 'V', 'S', 'D', 'L', 'M', 'X', 'J', 'V', 'S', 'D'],
                    datasets: [{
                        label: 'Horas trabajadas',
                        data: this.stock,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',

                        borderColor: 'rgba(75, 192, 192, 1)',

                        borderWidth: 1
                    }, 
                    {
                        label: 'Horas productivas',
                        data: [5, 6, 4, 5],
                        backgroundColor: 'rgba(75, 192, 192, 1)',

                        borderColor: 'rgba(75, 192, 192, 1)',

                        borderWidth: 1
                    }]
                },

                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: false
                        }
                    }
                }
            });
        }
    }
}
</script>

<style>

</style>
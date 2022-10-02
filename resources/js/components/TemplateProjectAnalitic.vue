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

    <div class="graphic">
        <canvas id="chartDayProject" ></canvas>
    </div>

    
</template>

<script>
    import Axios from 'axios';
    import Chart from "chart.js/auto";
    

export default {

    beforeMount() {
        this.reloadProject();

        Axios.get(`/graphic_day_project/${this.project.id}`)
        .then(respo => {
            let aux = 0;
            for (let i = 0; i < respo.data.length; i++) {
                if (i == 0) {
                    this.stock.push(parseInt(respo.data[i].time));
                    if (respo.data[i].productivity == 1) {
                        this.productivity.push(parseInt(respo.data[i].time));

                    } else {
                        this.productivity.push(0);
                    }
                    
                } else {
                    if (respo.data[i].created_at.substring(0, 10) == respo.data[i-1].created_at.substring(0, 10)) {
                        this.stock[aux] += parseInt(respo.data[i].time);
                        if (respo.data[i].productivity == 1) {
                            this.productivity[aux] += parseInt(respo.data[i].time);
                        }

                    } else {
                        let first = new Date(respo.data[i].created_at.substring(0, 10));
                        let second = new Date(respo.data[i-1].created_at.substring(0, 10));

                        let diference = Math.floor((first - second) / (1000 * 60 * 60 * 24));

                        while (diference > 1) {
                            this.stock.push(0);
                            this.productivity.push(0);
                            aux++;
                            diference--;
                        }

                        this.stock.push(parseInt(respo.data[i].time));
                        if (respo.data[i].productivity == 1) {
                            this.productivity.push(parseInt(respo.data[i].time));

                        } else {
                            this.productivity.push(0);
                        }
                        aux++;
                        
                    }
                }
                
            }

            this.selectDay();  
            },
            (error) => {
                console.log(error.response.data);
            })

    },

    props: ['project'],

    data() {
        return {
            index: [
                {title: 'Tiempo total',
                time: '0 s',
                help: 'Tiempo total dedicado al projecto'},

                {title: 'Tiempo productivo',
                time: '0 %',
                help: 'Porcentaje del tiempo productivo dedicado al projecto'},

                {title: 'Tiempo promedio',
                time: '0 s',
                help: 'Tiempo promedio por estudio'},

                {title: 'Tiempo improductivo',
                time: '0 %',
                help: 'Porcentaje del tiempo improductivo dedicado al projecto'}
                ],

            stock: [],
            productivity: [],
            label_day: ['L', 'M', 'X', 'J', 'V', 'S', 'D', 'L', 'M', 'X', 'J', 'V', 'S', 'D']
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

        reloadProject() {
            if (this.project.count != 0) {
                this.index[0].time = this.secondsToString(this.project.total_time);
                this.index[1].time = Math.round(this.project.time_product * 100 / this.project.total_time) + " %";
                this.index[2].time = this.secondsToString(Math.round(this.project.total_time/ this.project.count));
                this.index[3].time = Math.round(this.project.time_improduct * 100 / this.project.total_time) + " %";
            }
        }, 

        selectDay() {
            this.loadGraphic(this.productivity, this.stock, this.label_day, "#chartDayProject");
        }, 

        loadGraphic(productivity, stock, label, chart_id) {
            var myChart = new Chart(document.querySelector(chart_id), {
                type: 'bar', 
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Horas trabajadas',
                        data: stock,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',

                        borderColor: 'rgba(75, 192, 192, 1)',

                        borderWidth: 1
                    }, 
                    {
                        label: 'Horas productivas',
                        data: productivity,
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
<template>

    <v-app >


        <body class="my-4 mx-6">

        <v-btn class="primary" @click="getResults"> Obtener resultados de las pruebas </v-btn>
        <span v-if="success" class="green--text mt-5"> Resultados de las pruebas obtenidos satisfactoriamente </span>
        <span v-if="error" class="red--text mt-5"> {{this.error}} </span>
        <v-btn class="secondary mt-5" @click="getTeachers"> Obtener profesores </v-btn>

        <v-btn class="purple white--text mt-5" @click="getCompetencesAverage"> Obtener promedio </v-btn>

        <v-btn class="purple white--text mt-5" @click="getGraph"> Mostrar Grafico Resultados primer docente </v-btn>





        <!--     <ul>-->

        <!--         <li v-for="grade in grades" class="mt-5">-->

        <!--             <p> ID: {{grade.id}} </p>-->
        <!--             <p> Primer competencia: {{grade.first_competence_average}} </p>-->
        <!--             <p> Segunda competencia: {{grade.second_competence_average}} </p>-->
        <!--             <p> Tercera competencia: {{grade.third_competence_average}} </p>-->
        <!--             <p> Cuarta competencia: {{grade.fourth_competence_average}} </p>-->
        <!--             <p> Quinta competencia: {{grade.fifth_competence_average}} </p>-->
        <!--             <p> Sexta competencia: {{grade.sixth_competence_average}} </p>-->
        <!--             <p> Promedio de todas: </p>-->

        <!--         </li>-->


        <!--     </ul>-->


        <div class="graph">

            <canvas id="MiGrafica"></canvas>

        </div>


        </body>



    </v-app>



</template>


<script>

import axios from 'axios';
import Chart from "chart.js/auto";

export default {


    data(){

        return {

            results: [],

            error: "",

            success:false,

            teachers:[],

            dataToGraph: []
        }

    },

    methods:{


        async getResults(){

            // Peticion HTTP al endpoint de las respuestas creado anteriormente
            try {

                const resp = await axios.get('/api/answers')

                const array = resp.data

                console.log(array);

                this.results = array;

                this.success = true



            }


            catch (error){

                console.log(error);

                error.message="No se pudo obtener los resultados de las pruebas, verifica la petición"

                this.error = error.message

            }


        },


        getTeachers(){

            let teachers = []

            this.results.forEach( result => {

                if(this.teachers.includes(result.teacherName)){

                    return
                }

                else {

                    this.teachers.push(result.teacherName)
                }

            })

            teachers = this.teachers


            // Solucion punto 7 prueba tecnica
            console.log('docentes', teachers);

        },



        getCompetencesAverage(){



            this.teachers.forEach( teacher => {

                let C1 = 0
                let C2 = 0
                let C3 = 0
                let C4 = 0
                let C5 = 0
                let C6 = 0
                let counter = 0

                this.results.forEach( result => {

                    if (result.teacherName == teacher){

                        counter++
                        C1+= result.first_competence_average
                        C2+= result.second_competence_average
                        C3+= result.third_competence_average
                        C4+= result.fourth_competence_average
                        C5+= result.fifth_competence_average
                        C6+= result.sixth_competence_average


                    }





                })

                C1 = C1/counter
                C2 = C2/counter
                C3 = C3/counter
                C4 = C4/counter
                C5 = C5/counter
                C6 = C6/counter

                console.log(teacher,"Competencias",C1,C2,C3,C4,C5,C6);

                if(teacher == this.teachers[0]){

                    this.dataToGraph.push(C1,C2,C3,C4,C5,C6)

                    console.log(this.dataToGraph)
                }

                else{
                    return
                }

            })

        },


        getGraph(){

            let miCanvas = document.getElementById("MiGrafica").getContext("2d");

            var chart = new Chart(miCanvas, {
                type:"line",
                data:{
                    labels:["C1", "C2", "C3", "C4", "C5", "C6"],
                    datasets:[{

                        label: 'Grafica',
                        data:[ {x:4.81, y:this.dataToGraph[0]}, {x:2, y:this.dataToGraph[1]}, {x:2,y:this.dataToGraph[2]}, {x:2, y:this.dataToGraph[3]}, {x:2, y:this.dataToGraph[4]}, {x:2, y:this.dataToGraph[5]},],
                        showLine: true

                    }],

                },

                options:{

                    scales:{
                        x: {
                            position:"top",
                            title: {
                                display: true,
                                text: 'Competencias'
                            }

                        },

                        y:{
                            min:1,
                            max:5,
                            beginAtZero:false,
                            title: {
                                display: true,
                                text: 'Niveles'
                            },
                            ticks:{
                                stepSize: 1
                            }
                         }
                            // ticks:{
                            //
                            //
                            //     callback:function (value, index){
                            //         if(this.getLabelForValue(value) == 1 && this.getLabelForValue(value)){
                            //             return "C6"
                            //         }
                            //
                            //         if(this.getLabelForValue(value) == 2 && this.getLabelForValue(value)){
                            //             return "C5"
                            //         }
                            //
                            //         if(this.getLabelForValue(value) == 3 && this.getLabelForValue(value)){
                            //             return "C4"
                            //         }
                            //
                            //         if(this.getLabelForValue(value) == 4 && this.getLabelForValue(value)){
                            //             return "C3"
                            //         }
                            //
                            //         if(this.getLabelForValue(value) == 5 && this.getLabelForValue(value)){
                            //             return "C2"
                            //         }
                            //
                            //         if(this.getLabelForValue(value) == 6 && this.getLabelForValue(value)){
                            //             return "C1"
                            //         }
                            //     }
                            // }

                    },
                }
            })

        }
    },



    created(){

        // this.getGrades()



    },

    mounted() {

        // this.getGraph()
    }
}

</script>



<style>


.graph{

    width: 700px;
    height: 700px;

}

</style>

<template>
  <div class="container">
    <p class="my_title">WorkTimer</p>
    <div>
      <p class="my_second_title">¿Qué es WorkTimer?</p>
      <p class="text_tutorial">Una aplicación web que no dejarás de utilizar para controlar mejor tu tiempo de trabajo.</p>
      <br>
      <div class="embed-responsive embed-responsive-16by9 container_video">
        <iframe 
          class="embed-responsive-item video"
          v-bind:src="tutorial"
          frameborder="0"
          allowfullscreen
        ></iframe>
      </div>
    </div>

    <div style="margin-bottom: 6rem;">
      <p class="my_second_title" style="margin-top: 5rem; color: #138FB0;">Índice</p>
      <ul>
        <li><a class="text_tutorial index" href="#Cómo añadir una tarea">{{video_info[0][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo añadir un proyecto">{{video_info[1][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo ver el análisis de mis proyectos o tareas">{{video_info[2][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo eleminar mi cuenta">{{video_info[3][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo eliminar un proyecto o tarea">{{video_info[4][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo editar mis datos">{{video_info[5][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo editar un proyecto o tarea">{{video_info[6][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo ver el historial de tiempo">{{video_info[7][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo iniciar sesión">{{video_info[8][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo cerrar sesión">{{video_info[9][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo registrarme">{{video_info[10][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo iniciar el contador">{{video_info[11][0]}}</a></li>
        <li><a class="text_tutorial index" href="#Cómo parar el contador">{{video_info[12][0]}}</a></li>
      </ul>
      
    </div>

    <div v-for="element in video_info">
      <p v-bind:id="element[0]" class="my_second_title">{{element[0]}}</p>
      <br>
      <div class="embed-responsive embed-responsive-16by9 container_video" style="margin-bottom: 5rem;">
        <iframe 
          class="embed-responsive-item video"
          v-bind:src="element[1]"
          frameborder="0"
          allowfullscreen
        ></iframe>
      </div>
    </div>
    
    
  </div>
  
</template>

<script>
  
  import img_dir from '../img_dir'

export default {
  data() {
        return {
            tutorial: img_dir.url_video + img_dir.tutorial,
            video_info: [ ['Cómo añadir una tarea', img_dir.url_video + img_dir.video[0]],
                          ['Cómo añadir un proyecto', img_dir.url_video + img_dir.video[1]],
                          ['Cómo ver el análisis de mis proyectos o tareas', img_dir.url_video + img_dir.video[2]],
                          ['Cómo eleminar mi cuenta', img_dir.url_video + img_dir.video[3]],
                          ['Cómo eliminar un proyecto o tarea', img_dir.url_video + img_dir.video[4]],
                          ['Cómo editar mis datos', img_dir.url_video + img_dir.video[5]],
                          ['Cómo editar un proyecto o tarea', img_dir.url_video + img_dir.video[6]],
                          ['Cómo ver el historial de tiempo', img_dir.url_video + img_dir.video[7]],
                          ['Cómo iniciar sesión', img_dir.url_video + img_dir.video[8]],
                          ['Cómo cerrar sesión', img_dir.url_video + img_dir.video[9]],
                          ['Cómo registrarme', img_dir.url_video + img_dir.video[10]],
                          ['Cómo iniciar el contador', img_dir.url_video + img_dir.video[11]],
                          ['Cómo parar el contador', img_dir.url_video + img_dir.video[12]]]

        }
    },
}
</script>

<style>

</style>
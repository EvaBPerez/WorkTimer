<template>
    <header id="myHeader">
        <div class="row_new">
            <div class="col-3">
                <button id="time" class="timer_button">
                    <p class="timer">Comenzar <i class="bi bi-stopwatch" style="color: #e69bf0;"></i></p>
                </button>
            </div>

            <div class="col-6">
                <div class="title position-absolute top-40 start-50 translate-middle">
                    <router-link to="/my_proyects">
                        <h1 id="worktimer" >WorkTimer</h1>
                    </router-link>
                </div>
                
            </div>

            <div class="col-3">
                <p id="login">iniciar sesión</p>
            </div>
        </div>
            
        
        
    </header>

    <section style="padding-top: 4rem;">
        <router-view></router-view>
        
    </section>

    <foot></foot>
    
    
  
</template>

<script> 
    import foot from './Footer.vue'

export default {
    components: {foot}

}
</script>

<style>

</style>
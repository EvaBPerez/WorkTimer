<template>
    <div class="foot p-5 text-white d-flex justify-content-between">
        <div class="row" style="width: 100%;">
            <div class="col-3" style="text-align: center;">
                <img v-bind:src="logo" width="40" height="40" alt="Logo">
                <p>© 2022 WorkTimer</p>
            </div>

            <div class="col-6 container_fluid_new" style="text-align: center; margin-top: 2.2rem;">
                <span style="font-size: 160%"><i class="bi bi-instagram"></i></span>
                <span style="font-size: 160%"><i class="bi bi-facebook"></i></span>
                <span style="font-size: 160%"><i class="bi bi-youtube"></i></span>
                <span style="font-size: 160%"><i class="bi bi-linkedin"></i></span>
            </div>

            <div class="col-3" style="text-align: center; margin-top: 2.2rem;">
                <p>Contacto</p>
            </div>
            
        </div>
    </div>
</template>

<script>
    import img_dir from '../img_dir'

export default {
    data() {
        return {
            logo: img_dir.url + img_dir.logo,
        }
    },
}
</script>

<style>
    .foot {
        width: 100%;
        position: absolute;
        bottom: 0;
        background: #094154;
        border-radius: 10px 10px 0px 0px;
        align-self: flex-end;
    }
</style>
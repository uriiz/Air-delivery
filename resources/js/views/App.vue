<template>
    <div>
        <header-top></header-top>

            <!--<router-link :to="{ name: 'home' }">Home</router-link> |-->
            <!--<router-link :to="{ name: 'hello' }">Hello World</router-link>-->
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
<template>
    
</template>

<script>
    export default {
        name: "logout",
        mounted() {
            if (User.logedOut()){
                Toast.fire({
                    icon: 'success',
                    title: 'Logout Successfully'
                });

                this.$router.push({name:'login'});
            }
        },
    }
</script>

<style scoped>

</style>
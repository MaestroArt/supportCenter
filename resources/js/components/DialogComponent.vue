<template>
    <div class="container">
        <p :align="align">
        <b>{{user}} at {{dt}}:</b>
        </p>
        <p :align="align">
        {{msgtext}}
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            user:String,
            role:String,
            dt:String,
            msgtext:String
        },
        mounted() {
            console.log('Dialog component mounted.')
            this.update()
        },
        methods: {
            update: function() {
                console.log(this.user);
                console.log(this.role);
                console.log(this.dt);
            }
        },
        computed: {
            align() {
                if(this.role=="manager")
                    return "right";
                else
                    return "left";
             }
        }
    }
</script>


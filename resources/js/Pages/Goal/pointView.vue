<template>
    <button v-on:click="addOnePoint()">click</button>
    
    <div>
        Your current Point is <span style="color:blue">{{point}}</span>
    </div>
</template>

<script>
   

    export default {
        props: {
            point: {
                type: Number,
                required: true,
            } 
        },
        methods:{
            addFivePoint(){
                axios.put('point', {
                    point: this.point + 5
                })
                .then(response => {
                    if(response.status == 200){
                        this.$emit('pointchanged')
                    }
                })
                .catch(error=>{
                    console.log(error);
                })
            },
            addOnePoint(){
            
                axios.put('point',{
                    point: this.point + 1
                })
                .then( response => {
                    if( response.status == 200){
                        this.$emit('pointchanged');
                    }
                })
                .catch ( error => {
                    console.error(error);
                })
            }
        }
    }
</script>

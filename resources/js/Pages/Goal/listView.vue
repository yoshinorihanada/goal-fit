<template>
    <div>
        <div v-for="(goal,index) in goals" :key="index">
            <list-goal
                :goal="goal"
                class="goal"
                v-on:goalchanged="$emit('reloadlist')"
                v-on:pointchanged="$emit('reloadpoint')"
                />
        </div>
    </div>
</template>

<script>
import listGoal from "./listGoal"

export default {
    props: ['goals'],
    components:{
        listGoal
        
    }
}
</script>
<style scoped>
.goal {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;

}
</style>
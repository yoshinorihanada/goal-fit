<template>
    <div class="goal">
        <input 
            type="checkbox"
            @change="updateCheck()"
            v-model="goal.completed"
            />
        <span :class="[goal.completed ? 'completed' : '', 'goalText']">{{goal.name}}</span>
        \<span :class="[goal.completed ? 'completed' : '', 'goalText']">{{goal.due_date}}</span>
        <button @click="removeGoal()" class="trashcan">
            <font-awesome-icon icon="trash" />
        </button>
        
    </div>
</template>

<script>
export default {
    props: ['goal'],
    methods:{
        updateCheck(){
            axios.put('goal/' + this.goal.id, {
                goal: this.goal
            })
            .then(response => {
                if(response.status == 200){
                    this.$emit('goalchanged')
                    this.$emit('pointchanged')
                }
            })
            .catch(error=>{
                console.log(error);
            })
        },
        removeGoal(){
            axios.delete('goal/' + this.goal.id)
            .then( response => {
                if( response.status == 200){
                    this.$emit('goalchanged');
                }
            })
            .catch ( error => {
                console.error(error);
            })
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.goalText {
    width: 100%;
    margin-left: 20px;
}
.goal {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #FF0000;
    outline: none;
}
</style>
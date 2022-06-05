<template>
  <div class="new-task-container d-flex flex-column align-items-center p-3">
    <h2>New task</h2>
    <div class="mt-2" v-if="$store.state.tasks.mode !== 'new'">
      <button @click="$store.commit('tasks/setMode', 'new')" class="btn btn-primary">Add task</button>
    </div>
    <div class="w-100" v-if="$store.state.tasks.mode === 'new'">
      <TaskNewForm @cancel="$store.commit('tasks/setMode', 'default')" @sendFormData="addTask"/>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.new-task-container {
  box-shadow: 0 24px 84px 0 rgb(17 47 131 / 10%), 0 10px 24px -10px rgb(17 47 131 / 7%);
  width: 100%;

}
</style>

<script>
export default {
  name: 'TaskNew',
  props: {
  },
  data() {
    return {
      toggleNewTask: false,
    }
  },
  methods: {
    showNewTask() {
      this.toggleNewTask = !this.toggleNewTask
    },
    cancelNewTask() {
      this.toggleNewTask = false
    },
    async addTask (data) {

      let formData = new FormData();
      formData.append('title', data.title)
      formData.append('description', data.description)
      formData.append('file', data.file)
      formData.append('thumbnail', data.file.name)

      await this.$axios.$post(`${process.env.BASE_URL}/new`, formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        },
      } )
        .then((response) => {
          this.$store.commit('tasks/addTasks', response)
          this.$emit('taskAdded', 'added')
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
}
</script>

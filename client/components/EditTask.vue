<template>
  <div class="new-task-container d-flex flex-column align-items-center p-3">
    <h2>Edit Task: {{ task.title }}</h2>
    <div class="w-100 p-4">
      <EditTaskForm :task="task" @cancel="cancelNewTask" @sendFormData="editTask"/>
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
  name: 'NewTask',
  props: {
    task: {
      type: Object,
    }
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
    async editTask (data) {
      console.log(data)

      let formData = new FormData();

      formData.append('id', data.id)
      formData.append('title', data.title)
      formData.append('description', data.description)

      if (data.file || data.file !== null) {

        if(data.file.name !== this.task.thumbnail && data.file && data.fileName !== this.task.thumbnail) {
          formData.append('file', data.file)
          formData.append('thumbnail', data.file.name)
        }
      }

      await this.$axios.$post('http://localhost/api/edit', formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        },
      } )
        .then((response) => {
          console.log(response);
          this.$store.commit('tasks/clearEditedTask', response)
          this.$emit('taskEdited', 'edited')
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
}
</script>

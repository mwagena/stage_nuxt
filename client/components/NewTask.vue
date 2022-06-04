<template>
  <div class="new-task-container d-flex flex-column p-3">
    <TaskForm @addTask="addTask"/>
  </div>
</template>

<style lang="scss" scoped>
.new-task-container {
  box-shadow: 3px 3px 6px black;
  width: 100%;

}
</style>

<script>
export default {
  name: 'NewTask',
  props: {
  },
  methods: {
    async addTask (data) {

      let formData = new FormData();
      formData.append('title', data.title)
      formData.append('description', data.description)
      formData.append('file', data.file)
      formData.append('thumbnail', data.file.name)
      console.log(formData)
      await this.$axios.$post('http://localhost/api/new', formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        },
      } )
        .then((response) => {
          console.log(response);
          this.$store.commit('tasks/addTasks', response)
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
}
</script>

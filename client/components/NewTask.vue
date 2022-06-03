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
    async addTask (title, description, thumbnail) {
      event.preventDefault();
      // this.$store.commit('tasks/setTaskDone', id)
      await this.$axios.$post('http://localhost/api/new', {title: title, description: description, thumbnail: thumbnail} )
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
}
</script>

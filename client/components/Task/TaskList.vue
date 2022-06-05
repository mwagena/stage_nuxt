<template>
  <div class="task-list-container my-5">
    <h3>{{ title }}</h3>
    <div v-for="task in tasks">
      <Task class="my-3" @editTask="editTask" @delete="deleteTask" @toggleComplete="completeTask" :editing="editing" :task="task"/>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.task-section-container {
  width: 100%;
}
</style>

<script>
export default {
  name: 'TaskList',
  props: {
    tasks: {
      type: Array,
    },
    title: {
      type: String,
    }
  },
  data() {
    return {
      editing: false,
    }
  },
  methods: {
    async completeTask (id) {
      this.$store.commit('tasks/setTaskDone', id)
      await this.$axios.$post(`${process.env.BASE_URL}/done`, {id: id} )
        .then(function (response) {
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    editTask (task ) {
      this.editing = !this.editing;
      this.$store.commit('tasks/editTask', task);
    },
    async deleteTask(task) {
      this.$store.commit('tasks/removeTask', task.id)
      this.$emit('taskDeleted', 'deleted')
      await this.$axios.$post(`${process.env.BASE_URL}/delete`, {id: task.id} )
        .then(function (response) {

        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
}
</script>

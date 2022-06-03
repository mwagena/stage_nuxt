<template>
  <div class="task-section-container">
    <div class="my-3">
      <NewTask/>
    </div>
   <TaskList title="All tasks" :tasks=allTasks />
    <TaskList title="Completed tasks" :tasks=completedTasks />
  </div>
</template>

<style lang="scss" scoped>
  .task-section-container {
  width: 100%;
  }
</style>

<script>
export default {
  name: 'TaskSection',
  data() {
    return {
      tasks: []
    }
  },
  async fetch() {
    this.tasks = await fetch(
      'http://localhost/api'
    ).then(res => res.json())
    .then(res => {
      res.forEach(task =>  this.$store.commit('tasks/addTasks', task))

    })
  },
  computed: {
    completedTasks() {
      return this.$store.getters["tasks/getCompletedTasks"]
    },
    allTasks() {
      return this.$store.getters["tasks/getAllTasks"]
    }
  }
}
</script>
<!--this.$store.commit('tasks/addTasks', this.res.json())-->

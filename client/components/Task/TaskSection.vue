<template>
  <div class="task-section-container">

    <TaskAlert ref="taskAlert" :mode="alertMode" />

    <div class="my-3">
      <TaskNew @taskAdded="showAlert"/>
    </div>
    <div v-if="$store.state.tasks.mode === 'edit'" v-for="task in $store.state.tasks.edit">
      <TaskEdit @taskEdited="showAlert" :task="task" />
    </div>
   <TaskList @taskDeleted="showAlert" title="All tasks" :tasks=allTasks />
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
      tasks: [],
      alertMode: ''
    }
  },
  async fetch() {
    this.tasks = await fetch(
      process.env.BASE_URL)
      .then(res => res.json())
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
    },
  },
  methods: {
    showAlert(mode) {
      this.alertMode = mode
      this.$refs.taskAlert.showAlert();
    }
  }
}
</script>

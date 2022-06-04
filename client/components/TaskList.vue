<template>
  <div class="task-list-container">
    <h3>{{ title }}</h3>
    <div v-for="task in tasks">
      <Task class="my-3" @toggleComplete="completeTask" :task="task"/>
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
    }
  },
  methods: {
    async completeTask (id) {
      this.$store.commit('tasks/setTaskDone', id)
      await this.$axios.$post('http://localhost/api/done', {id: id} )
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

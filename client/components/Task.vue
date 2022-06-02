<template>
  <div class="task-list-container">
    <div class="d-flex align-items-center">
      <input @change="$emit('toggleComplete', task.id)" type="checkbox">
      <div class="px-4">
        {{ task.title }}
        <font-awesome-icon icon="fa-solid fa-pen-to-square" />
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.task--container {

}
</style>

<script>
export default {
  name: 'Task',
  props: {
    task: {
      value: Array,
    },
  },
  data() {
    return {
    }
  },
}
</script>

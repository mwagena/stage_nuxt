<template>
  <div class="task-container d-flex flex-column p-3">
    <div class="d-flex align-items-center justify-content-between">
      <input @change="$emit('toggleComplete', task.id)" type="checkbox">
      <div class="px-4 task-title">
        <strong :style="task.done ? 'text-decoration: line-through;' : '' ">{{ task.title }}</strong>
      </div>
      <button @click="toggleMoreInfo" class="btn btn-primary">Show more info</button>
    </div>
    <div v-if="showMore" class="d-flex align-items-center justify-content-between py-3">
      <nuxt-img :src="imgPreUrl + task.thumbnail" width="300" height="169"/>

      <p>{{task.description}}</p>
      <div>
        <b-button variant="primary" @click="$emit('editTask', task)" >{{ editing ? 'Stop editing' : 'Edit' }}</b-button>
        <b-button variant="danger" @click="alertMe" v-b-modal.modal-1>Delete</b-button>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.task-container {
  border: 1px solid;
  width: 100%;

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
      showMore: false,
      editing: false,
      imgPreUrl: 'http://localhost/storage/images/'
    }
  },
  methods: {
    alertMe() {
      if (confirm("Are you sure you want to delete this task?")) {
        this.$emit('delete', this.task)
      } else {
        console.log('nope')
      }

    },
    toggleMoreInfo() {
      this.showMore = !this.showMore;
    }
  }
}
</script>

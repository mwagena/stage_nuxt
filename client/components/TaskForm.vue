<template>
  <div class="task-form-container">
    <b-form @submit="$emit('addTask', ...form)" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Task title:"
        label-for="input-title"
      >
        <b-form-input
          id="input-title"
          v-model="form.title"
          type="text"
          placeholder="Enter task title"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your Description:" label-for="input-description">
        <b-form-textarea
          id="input-description"
          v-model="form.description"
          placeholder="Enter something..."
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-3" label="Food:" label-for="input-3">
        <b-form-file
          v-model="form.file"
          :state="Boolean(form.file)"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
        ></b-form-file>
        <div class="mt-3">Selected file: {{ form.file ? form.file.name : '' }}</div>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<style lang="scss" scoped>

</style>

<script>
export default {
  name: 'TaskForm',
  data() {
    return {
      form: {
        title: '',
        description: '',
        file: null,
      },
      show: true
    }
  },
  methods: {
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.title = ''
      this.form.description = ''
      this.form.file = null
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }
}
</script>

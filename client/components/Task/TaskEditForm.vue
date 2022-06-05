<template>
  <div class="task-form-container">
    <b-form @submit="onSubmit" @reset="onReset" v-if="show" enctype="multipart/form-data">
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
        <span class="task-input-error">{{errors.title.value}}</span>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your Description:" label-for="input-description">
        <b-form-textarea
          id="input-description"
          v-model="form.description"
          placeholder="Enter something..."
          rows="3"
          max-rows="6"
        ></b-form-textarea>
        <span class="task-input-error">{{errors.description.value}}</span>
      </b-form-group>

      <b-form-group id="input-group-3" label="Thumbnail:" label-for="input-3">
        <b-form-file
          v-model="form.file"
          :state="Boolean(form.file)"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
        ></b-form-file>
        <span class="task-input-error">{{errors.file.value}}</span>
        <div class="mt-3">
          <nuxt-img :src="imgPreUrl + task.thumbnail" width="300" height="169"/>
        </div>

        <div class="mt-3">Current thumbnail: {{ form.file ? form.file : '' }}</div>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
      <b-button @click="$store.commit('tasks/setMode', 'default')" variant="dark">Cancel</b-button>
    </b-form>
  </div>
</template>

<style lang="scss" scoped>
.task-input-error {
  color: red;
}
</style>

<script>
export default {
  name: 'TaskEditForm',
  props: {
    task: {
      type: Object
    },
    editing: {
      type: Boolean,
    }
  },
  data() {
    return {
      form: {
        title: this.task.title ? this.task.title : '',
        description: this.task.description ? this.task.description : '',
        file: null,
        fileName: this.task.file,
        id: this.task.id ? this.task.id : null,
      },
      errors: {
        title: {
          value: '',
        },
        description: {
          value: ''
        },
        file: {
          value: ''
        }
      },
      show: true,
      imgPreUrl: process.env.IMG_URL
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()

      if(!this.validation().length > 0 ) {
        let formData = {
          title: this.form.title,
          description: this.form.description,
          file: this.form.file,
          fileName: this.form.fileName,
          id: this.form.id
        }

        this.$emit('sendFormData', formData)
        }

    },
    validation() {
      let errors = [];
      if (this.form.title.length < 5) {
        this.errors.title.value = 'Please use a title of 5 or more characters';
        errors.push(this.errors.title)
      }
      if (this.form.title.length > 100) {
        this.errors.title.value = 'Please use a title of less than 100 characters';
        errors.push(this.errors.title)
      }
      if (this.form.description.length < 5 ) {
        this.errors.description.value = 'Please use a description of 5 or more characters';
        errors.push(this.errors.description)
      }
      if (this.form.description.length > 250 ) {
        this.errors.description.value = 'Please use a description of less than 250 characters';
        errors.push(this.errors.description)
      }

      return errors
    },
    onReset(event) {
      event.preventDefault()
      // Reset form values
      this.form.title = this.task.title ? this.task.title : ''
      this.form.description = this.task.description ? this.task.description : ''
      this.form.file = null

      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }
}
</script>

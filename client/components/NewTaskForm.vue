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
          <nuxt-img v-if="task" :src="imgPreUrl + task.thumbnail" width="300" height="169"/>
        </div>

        <div class="mt-3">Current thumbnail: {{ form.file ? form.file : '' }}</div>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
      <b-button @click="$emit('cancel')" variant="dark">Cancel</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<style lang="scss" scoped>
.task-input-error {
  color: red;
}
</style>

<script>

export default {
  name: 'TaskForm',
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
        title: '',
        description:  '',
        file: null,
        id: null,
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
      imgPreUrl: 'http://localhost/storage/images/'
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
          thumbnail: this.form.file,
          id: this.form.id
        }

        if(this.errors.title.value !== '') {
          this.errors.title.value = ''
        }
        if(this.errors.description.value !== '') {
          this.errors.description.value = ''
        }
        if(this.errors.file.value !== '') {
          this.errors.file.value = ''
        }

        this.$emit('sendFormData', formData)

        this.onReset();
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
      if(!this.form.file) {
        this.errors.file.value = 'You forgot a thumbnail';
        errors.push(this.errors.file)
      }

      return errors
    },
    onReset(event) {
      if(event) {
        event.preventDefault()
      }

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

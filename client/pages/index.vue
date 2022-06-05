<template>
  <b-container fluid="md">
  <b-row class="d-flex justify-content-center my-3">
    <h1>Todo App</h1>
  </b-row>
  <b-row>
    <b-col class="col-md-8 offset-md-2 my-3">
      <TaskSection />
    </b-col>
  </b-row>


  </b-container>
</template>

<script>
export default {
  name: 'IndexPage'
}
</script>

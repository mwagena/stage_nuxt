export const state = () => ({
  tasks: [],
})

export const mutations = {
  addTasks(state, task) {
    state.tasks.push(task)
  },
  setTaskDone(state, id){
    state.tasks.forEach((task) => {
      if (task.id === id) {
        task.done = !task.done
      }
    })
  }
}
export const actions = {}
export const getters = {
  getAllTasks: (state)  => {
    return state.tasks
  },
  getCompletedTasks (state) {
    return state.tasks.filter(task => task.done)
  },
}

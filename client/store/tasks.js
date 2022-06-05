export const state = () => ({
  tasks: [],
  edit: [],
  mode: 'default'
})

export const mutations = {
  setMode(state, mode) {
      state.mode = mode;
  },

  addTasks(state, task) {
    const found = state.tasks.some(el => el.id === task.id);
    if(!found){
      state.tasks.push(task)
    }
    state.mode = 'default'
  },
  setTaskDone(state, id){
    state.tasks.forEach((task) => {
      if (task.id === id) {
        task.done = !task.done
      }
    })
  },
  clearEditedTask(state, response) {
    state.tasks.forEach((task) => {
      if (task.id === response.id) {
        this.task = Object.assign(task, response)
      }
    })
    state.edit = [];
  },
  addEditedTask(state, editedTask) {
    let newTaskList = state.tasks.filter((task)=> {
      return task.id === editedTask.id;
    })
    newTaskList.push(editedTask)
    state.tasks.push(newTaskList)

  },
  editTask(state, task) {
    state.mode = 'edit';
    if (!state.edit.length > 0) {
      state.edit.push(task)
    } else {
      state.edit = []
      state.edit.push(task)
    }
  },
  removeTask(state, id) {
    const i = state.tasks.map(task => task.id).indexOf(id);
    state.tasks.splice(i, 1);
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

// Elementos HTML
const userSelect = document.getElementById('select-users');
const userContainer = document.getElementById('user-container');
const taskContainer = document.getElementById('task-container');
const taskList = document.querySelector('#task-container ul');

// Funciones
/**
 * Optiene una lista de todos los usuarios que pueden existir
 * @returns {Promise<User[]>}
 */
function getAllUsers() {
  return fetch('/data/usuarios.json')
    .then(resp => resp.json());
}

/**
 * Optiene una lista de todas las tareas que hay de todos los usuarios
 * @returns {Promise<Task[]>}
 */
function getAllTasks() {
  return fetch('/data/tareas.json')
    .then(resp => resp.json());
}

/**
 * Muestra la información del usuario seleccionado
 * @param {User} user Usuario seleccionado
 */
function displayUserInfo(user) {
  userContainer.innerHTML = `
    <h3>Informacion del usuario seleccionado</h3>
    <ul>
      <li>Nombre completo: ${user.firstname} ${user.lastname}</li>
      <li>Email: ${user.email}</li>
    </ul>
  `;
}

/**
 * Muestra las tareas del usuario seleccionado
 * @param {Task[]} tasks Lista de tareas del usuario seleccionado
 */
function displayUserTasks(tasks) {
  taskList.innerHTML = '';
  tasks.forEach(task => {
    const taskItem = document.createElement('li');
    taskItem.innerHTML = `
      <span>${task.title}</span>
      <input type="checkbox" ${task.completed ? 'checked' : ''}>
    `;
    taskList.appendChild(taskItem);
  });
}

// Evento para cambiar de usuario seleccionado
userSelect.addEventListener('change', () => {
  const userId = parseInt(userSelect.value);
  
  getAllUsers()
    .then(users => {
      const selectedUser = users.find(user => user.id === userId);
      if (selectedUser) {
        displayUserInfo(selectedUser);
      } else {
        userContainer.innerHTML = '<p>Usuario no encontrado</p>';
      }
    })
    .catch(error => console.error('Error al obtener usuarios:', error));
});

// Evento para mostrar las tareas del usuario seleccionado
document.getElementById('show-tasks-btn').addEventListener('click', () => {
  const userId = parseInt(userSelect.value);

  getAllTasks()
    .then(tasks => {
      const userTasks = tasks.filter(task => task.userId === userId);
      displayUserTasks(userTasks);
    })
    .catch(error => console.error('Error al obtener tareas:', error));
});

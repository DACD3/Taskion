const VIEWS_URL = [
  {
    id: "create-project",
    url: `${window.location.origin}/assets/views/createProject.php`, // Usa origin para evitar el problema del href
  },
  {
    id: "create-task",
    url: `${window.location.origin}/assets/views/createTask.php`, // Añade la URL correcta
  },
]

const sidebarEl = $("sidebar")
const togglerEl = $("toggler")

togglerEl.addEventListener("click", () => {
  sidebarEl.classList.toggle("open")
})

const handleClick = async (e) => {

  const id = e.currentTarget.id;

  const view = VIEWS_URL.find( v => v.id === id);

  const res = await fetch(view.url)

  const content = await res.text()

  $("form-container").innerHTML = content
}

const actions = document.querySelectorAll(".button-link")

actions.forEach(async (el) => {
  el.addEventListener("click", handleClick)
})
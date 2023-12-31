const FORMS = [
  {
    id: "project",
    formId: `form-project`
  },
  {
    id: "task",
    formId: `form-task`,
  },
]

const sidebarEl = $("sidebar")
const togglerEl = $("toggler")

togglerEl.addEventListener("click", () => {
  sidebarEl.classList.toggle("open")
})

const tabs = document.querySelectorAll('.tab-button');

const handleTabChange = (e) => {
  tabs.forEach(el => el.classList.remove('active'));
  
  const forms = document.querySelectorAll('.form');

  forms.forEach(el => el.classList = "form");

  let tab = e.target;

  tab.classList.add('active');

  let form = FORMS.find(el => el.id === tab.id);
  let formEl = $(form.formId);

  formEl.classList.add('visible');  
}

tabs.forEach(el => {
  el.addEventListener('click', handleTabChange);
});

const createProjectForm = $('form-project');

createProjectForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  const formData = new FormData(e.target);

  try {
    const request = await fetch('/app?operation=createProject', {
      method: "POST",
      body: formData
    });

    if (request.ok) {
      window.location.reload();
    }
  }
  catch(ex) {
    console.error(ex);
  }

});
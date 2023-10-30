const sidebarEl = $('sidebar');
const togglerEl = $('toggler');

togglerEl.addEventListener('click', () => {

  sidebarEl.classList.toggle('open');

})
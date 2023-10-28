const avatarEl = $("Avatar")
const previewEl = $("Avatar-image")

avatarEl.addEventListener("change", (e) => {
  const file = e.target.files[0];

  console.log(file);

  if (file) {
    const reader = new FileReader()

    reader.addEventListener("load", (e) => {
      previewEl.src = e.target.result
    })

    reader.readAsDataURL(file)
  }
});

previewEl.addEventListener('click', () => {
  previewEl.src = "";
});
const target = document.getElementById("logo_mark");
target.addEventListener('click', () => {
  target.classList.toggle('open');
  const nav = document.getElementById("menu");
  nav.classList.toggle('in');
});
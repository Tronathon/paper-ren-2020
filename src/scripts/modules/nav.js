const nav = document.querySelector('.js-nav');
const menuItems = document.querySelector('.js-nav-items');

nav.addEventListener('click', toggle);

function toggle() {
	menuItems.classList.toggle('active');
	nav.classList.toggle('open');
}

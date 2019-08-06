import Cookies from 'js-cookie';

const notice = document.getElementById('cookie-notice');
const controls = Array.from(document.querySelectorAll('.js-cookie-consent'));
const className = 'is-visible';
const cookieName = 'cookie_consent';

if (notice && !Cookies.get(cookieName)) {
	notice.classList.add(className);
	controls.forEach(control => control.addEventListener('click', e => onClick(e)));
}

function onClick(event) {
	notice.classList.remove(className);
	Cookies.set(cookieName, 'true', { expires: 365 });
}

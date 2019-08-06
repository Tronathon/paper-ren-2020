/**
 * Async font loading via FontFaceObserver
 */

import FontFaceObserver from 'fontfaceobserver';
import Cookies from 'js-cookie';

const typefaces = {};

export default function init() {
	if (Cookies.get('fonts-loaded')) {
		return false;
	}

	loadFonts().then(function() {
		document.documentElement.classList.add('fonts-loaded');
		Cookies.set('fonts-loaded', '1', { expires: 7, secure: true });
	});
};

function loadFonts() {
	const fonts = [];

	Object.keys(typefaces).forEach(family => {
		typefaces[family].map(variant => {
			const loader = new FontFaceObserver(family, variant);
			fonts.push(loader.load());
		});
	});

	return Promise.all(fonts);
}

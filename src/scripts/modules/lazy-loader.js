const defaults = {
	root: null,
	rootMargin: '15%',
	threshold: 0,

	srcAttr: 'data-src',
	srcsetAttr: 'data-srcset',
	selector: '[data-src], [data-srcset]',

	onLoad: elem => elem.classList.add('has-loaded'),
	onError: elem => elem.classList.add('has-errored'),
};

export default function Lazy(options) {
	const config = { ...defaults, ...options };

	const io = new IntersectionObserver(onIntersection, {
		root: config.root,
		rootMargin: config.rootMargin,
		threshold: config.threshold,
	});

	let elements;

	document.addEventListener('DOMContentLoaded', () => update());

	function getElements() {
		return [...document.querySelectorAll(config.selector)];
	}

	function update() {
		elements = getElements();
		elements.forEach(elem => io.observe(elem));
	}

	function onIntersection(entries) {
		entries.filter(entry => entry.isIntersecting).map(entry => load(entry.target));
	}

	function setAttributes(elem) {
		const { srcAttr, srcsetAttr } = config;

		const src = elem.getAttribute(srcAttr);
		const srcset = elem.getAttribute(srcsetAttr);

		if (srcset) {
			elem.srcset = srcset;
			elem.removeAttribute(srcsetAttr);
		}

		if (src) {
			elem.src = src;
			elem.removeAttribute(srcAttr);
		}
	}

	function load(elem) {
		const index = elements.indexOf(elem);

		elem.onload = () => config.onLoad(elem);
		elem.onerror = () => config.onError(elem);

		setAttributes(elem);

		io.unobserve(elem);
		elements.splice(index, 1);
	}

	return { update };
}



import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * Theme helpers: store preference in localStorage and toggle the `dark` class
 * on the documentElement. This keeps Tailwind's class-based dark mode in sync.
 */
function getStoredTheme() {
	try {
		return localStorage.getItem('theme');
	} catch (e) {
		return null;
	}
}

function storeTheme(theme) {
	try {
		localStorage.setItem('theme', theme);
	} catch (e) {
		// ignore
	}
}

function applyTheme(theme) {
	const root = document.documentElement;
	if (theme === 'dark') {
		root.classList.add('dark');
	} else {
		root.classList.remove('dark');
	}
}

function initTheme() {
	const stored = getStoredTheme();
	if (stored) {
		applyTheme(stored);
	} else {
		// default to system preference
		const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
		applyTheme(prefersDark ? 'dark' : 'light');
	}
}

window.toggleTheme = function () {
	const isDark = document.documentElement.classList.contains('dark');
	const next = isDark ? 'light' : 'dark';
	applyTheme(next);
	storeTheme(next);
};

initTheme();

Alpine.start();

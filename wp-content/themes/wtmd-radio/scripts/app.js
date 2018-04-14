/*
 * Main entry point
 */

import 'bootstrap/js/dist/carousel';

import analytics from './components/analytics.js';
import social from './components/social.js';
import ui from './components/ui.js';

/**
 * Initialize the app on DOM ready
 */
$(function() {
	analytics.init({
        addGA: false,
		addGTM: false
	});
	social.init({
		fbAppId: ''
	});
	ui.init();
});
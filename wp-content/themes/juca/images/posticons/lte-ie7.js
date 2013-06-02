/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'IcoMoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-quote-left' : '&#x22;',
			'icon-comment6' : '&#x21;',
			'icon-pencil' : '&#x23;',
			'icon-document' : '&#x24;',
			'icon-camera' : '&#x25;',
			'icon-images' : '&#x26;',
			'icon-film' : '&#x27;',
			'icon-music' : '&#x28;',
			'icon-link' : '&#x29;',
			'icon-out' : '&#x2a;',
			'icon-user' : '&#x2b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^s'"]+/);
		if (c) {
			addIcon(el, icons[c[0]]);
		}
	}
};
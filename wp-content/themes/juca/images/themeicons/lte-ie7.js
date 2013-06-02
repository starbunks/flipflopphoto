/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'IcoMoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-comment-cancel2' : '&#x78;',
			'icon-comment-add2' : '&#x2b;',
			'icon-grid' : '&#x23;',
			'icon-close' : '&#x58;',
			'icon-arrow-down2' : '&#x56;',
			'icon-untitled' : '&#x28;',
			'icon-arrow-down' : '&#x76;',
			'icon-arrow-left-rounded' : '&#x3c;',
			'icon-arrow-right-rounded' : '&#x3e;',
			'icon-pause' : '&#x70;',
			'icon-play' : '&#x50;'
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
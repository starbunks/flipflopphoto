/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'IcoMoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-email' : '&#x21;',
			'icon-google-plus' : '&#x22;',
			'icon-facebook' : '&#x23;',
			'icon-twitter' : '&#x24;',
			'icon-feed' : '&#x25;',
			'icon-youtube' : '&#x26;',
			'icon-vimeo' : '&#x27;',
			'icon-flickr' : '&#x28;',
			'icon-picassa' : '&#x29;',
			'icon-dribbble' : '&#x2a;',
			'icon-forrst' : '&#x2b;',
			'icon-deviantart' : '&#x2c;',
			'icon-github' : '&#x2d;',
			'icon-wordpress' : '&#x2e;',
			'icon-blogger' : '&#x2f;',
			'icon-tumblr' : '&#x30;',
			'icon-yahoo' : '&#x31;',
			'icon-amazon' : '&#x32;',
			'icon-soundcloud' : '&#x33;',
			'icon-android' : '&#x34;',
			'icon-apple' : '&#x35;',
			'icon-windows' : '&#x36;',
			'icon-skype' : '&#x37;',
			'icon-reddit' : '&#x38;',
			'icon-linkedin' : '&#x39;',
			'icon-lastfm' : '&#x3a;',
			'icon-delicious' : '&#x3b;',
			'icon-stumbleupon' : '&#x3c;',
			'icon-pinterest' : '&#x3d;'
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
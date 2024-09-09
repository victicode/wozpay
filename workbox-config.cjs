module.exports = {
	globDirectory: 'public/',
	globPatterns: [
		'**/*.{css,js,woff,woff2,png,svg,json,webp,php,log}'
	],
	swDest: 'public/sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};
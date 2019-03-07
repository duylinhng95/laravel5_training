const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/post.js', 'public/js/post.js')
	 .js('resources/js/app.js', 'public/js/app.js')
	 .js('resources/js/admin.js', 'public/js/admin.js')
	 .js('resources/js/category.js', 'public/js/category.js')
	 .js('resources/js/comment.js', 'public/js/comment.js')
	 .js('resources/js/homepage.js', 'public/js/homepage.js')
	 .js('resources/js/interest.js', 'public/js/interest.js')
	 .js('resources/js/browse.js', 'public/js/browse.js')
	 .sass('resources/sass/app.scss', 'public/css')
	 .sass('resources/sass/admin.scss', 'public/css')
	 .sass('resources/sass/post.scss', 'public/css')
	 .sass('resources/sass/homepage.scss', 'public/css')
	 .version()

mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/js/vendor', 'public/js/vendor');
mix.copyDirectory('resources/sass/vendor', 'public/css/vendor');
mix.disableNotifications();
let webpack = require('webpack');

mix.webpackConfig({
	plugins: [
		new webpack.IgnorePlugin(/^codemirror$/)
	]
});
// mix.autoload({
// 	jquery: ['$', 'window.jQuery', 'jQuery'],
// 	'popper.js/dist/umd/popper.js': ['Popper']
// });

// mix.autoload({
// 	jquery: ['$', 'window.jQuery', 'jQuery'],
// 	'popper.js/dist/umd/popper.js': ['Popper']
// })
// 	.js('resources/js/app.js', 'public/js')
// 	.sass('resources/sass/app.scss', 'public/css')
// 	.version()


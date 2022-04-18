const mix = require('laravel-mix');

mix
    .setResourceRoot("")
    .options({
        processCssUrls: false,
    })
    .js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .copyDirectory(
        'node_modules/@fortawesome/fontawesome-free/webfonts/**',
        'public/webfonts'
    )
    .copyDirectory('resources/images', 'public/images');

if (mix.inProduction()) {
    mix
        .version();
}

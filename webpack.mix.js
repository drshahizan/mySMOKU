const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');
const WebpackRTLPlugin = require('webpack-rtl-plugin');
const del = require('del');
const fs = require('fs');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// arguments/params from the line command
const args = getParameters();

// get selected demo
let demo = getDemos()[0];

const dir = 'resources/_keenthemes/src';

mix.options({
    cssNano: {
        discardComments: false,
    }
});

// Remove existing generated assets from public folder
del.sync(['public/assets/*',]);

// Build 3rd party plugins css/js
mix.sass('resources/mix/plugins.scss', `public/assets/plugins/global/plugins.bundle.css`).then(() => {
    // remove unused preprocessed fonts folder
    rimraf(path.resolve('public/fonts'), () => {
    });
    rimraf(path.resolve('public/images'), () => {
    });
}).sourceMaps(!mix.inProduction())
    // .setResourceRoot('./')
    .options({processCssUrls: false})
    .scripts(require('./resources/mix/plugins.js'), `public/assets/plugins/global/plugins.bundle.js`);

// Build theme css/js
mix.sass(`${dir}/sass/style.scss`, `public/assets/css/style.bundle.css`, {sassOptions: {includePaths: ['node_modules']}})
    // .options({processCssUrls: false})
    .scripts(require(`./resources/mix/scripts.js`), `public/assets/js/scripts.bundle.js`);

// Build custom 3rd party plugins
(glob.sync(`resources/mix/vendors/**/*.js`) || []).forEach(file => {
    mix.scripts(require('./' + file), `public/assets/${file.replace('resources/mix/vendors/', 'plugins/custom/')}`);
});
(glob.sync(`resources/mix/vendors/**/*.scss`) || []).forEach(file => {
    mix.sass(file, `public/assets/${file.replace('resources/mix/vendors/', 'plugins/custom/').replace('scss', 'css')}`);
});

// JS pages (single page use)
(glob.sync(`${dir}/js/custom/**/*.js`) || []).forEach(file => {
    var output = `public/assets/${file.replace(`${dir}/`, '')}`;
    mix.scripts(file, output);
});

// Build media
mix.copyDirectory(`${dir}/media`, `public/assets/media`);

let plugins = [
    new ReplaceInFileWebpackPlugin([
        {
            // rewrite font paths
            dir: path.resolve(`public/assets/plugins/global`),
            test: /\.css$/,
            rules: [
                {
                    // fontawesome
                    search: /url\((\.\.\/)?webfonts\/(fa-.*?)"?\)/g,
                    replace: 'url(./fonts/@fortawesome/$2)',
                },
                {
                    // lineawesome fonts
                    search: /url\(("?\.\.\/)?fonts\/(la-.*?)"?\)/g,
                    replace: 'url(./fonts/line-awesome/$2)',
                },
                {
                    // bootstrap-icons
                    search: /url\(.*?(bootstrap-icons\..*?)"?\)/g,
                    replace: 'url(./fonts/bootstrap-icons/$1)',
                },
                {
                    // fonticon
                    search: /url\(.*?(fonticon\..*?)"?\)/g,
                    replace: 'url(./fonts/fonticon/$1)',
                },
                {
                    // keenicons
                    search: /url\(.*?((keenicons-.*?)\..*?)'?\)/g,
                    replace: 'url(./fonts/$2/$1)',
                },
            ],
        },
    ]),
];
if (args.indexOf('rtl') !== -1) {
    plugins.push(new WebpackRTLPlugin({
        filename: '[name].rtl.css',
        options: {},
        plugins: [],
        minify: false,
    }));
}

mix.webpackConfig({
    plugins: plugins,
    ignoreWarnings: [{
        module: /esri-leaflet/,
        message: /version/,
    }],
});

// Webpack.mix does not copy fonts, manually copy
(glob.sync(`${dir}/plugins/**/*.+(woff|woff2|eot|ttf|svg)`) || []).forEach(file => {
    mix.copy(file, `public/assets/plugins/global/fonts/${path.parse(file).name}/${path.basename(file)}`);
});
glob.sync('node_modules/+(@fortawesome|socicon|line-awesome|bootstrap-icons)/**/*.+(woff|woff2|eot|ttf)').forEach(file => {
    const [, folder] = file.match(/node_modules\/(.*?)\//);
    mix.copy(file, `public/assets/plugins/global/fonts/${folder}/${path.basename(file)}`);
});
(glob.sync('node_modules/jstree/dist/themes/default/*.+(png|gif)') || []).forEach(file => {
    mix.copy(file, `public/assets/plugins/custom/jstree/${path.basename(file)}`);
});

// Widgets
mix.scripts((glob.sync(`${dir}/js/widgets/**/*.js`) || []), `public/assets/js/widgets.bundle.js`);

function getDemos() {
    // get possible demo from parameter command
    let demos = [];
    args.forEach((arg) => {
        const demo = arg.match(/^demo.*/g);
        if (demo) {
            demos.push(demo[0]);
        }
    });
    if (demos.length === 0) {
        demos = ['demo1'];
    }
    return demos;
}

function getParameters() {
    var possibleArgs = [
        'rtl'
    ];
    for (var i = 0; i <= 13; i++) {
        possibleArgs.push('demo' + i);
    }

    var args = [];
    possibleArgs.forEach(function (key) {
        if (process.env['npm_config_' + key]) {
            args.push(key);
        }
    });

    return args;
}

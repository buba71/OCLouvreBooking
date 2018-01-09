var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())


    // uncomment to define the assets of the project
    .addEntry('js/app', './assets/js/app.js')
    // adding images
    .addEntry('png/logo','./assets/images/logo.png')
    .addEntry('jpg/1','./assets/images/1.jpg')
    .addEntry('jpg/2','./assets/images/2.jpg')
    .addEntry('jpg/3','./assets/images/3.jpg')
    // adding stylesheet
    .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/custom', './assets/css/custom.css')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();

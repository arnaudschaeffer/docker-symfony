var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .setManifestKeyPrefix('/')

    .addEntry('layout', './assets/js/layout.js')

    //.enableBuildNotifications()
    // fixes modules that expect jQuery to be global
    .autoProvidejQuery()

    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // enables Sass/SCSS support
    .enableSassLoader()
    .enablePostCssLoader()

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]'
    })

    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()

    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
;

// export the final configuration
module.exports = Encore.getWebpackConfig();
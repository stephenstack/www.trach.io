const mix = require("laravel-mix");
let webpack = require("webpack");
require("laravel-mix-purgecss");

const tailwindcss = require("tailwindcss");

// Override mix internal webpack output configuration for code spliting
mix.config.webpackConfig.output = {
    chunkFilename: "js/[name].bundle.js",
    publicPath: "/"
};
mix.webpackConfig({
    plugins: [
        // Choose the language you want to keep (Ex: "fr")
        //   new webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en/)
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
});

mix.js("resources/js/app.js", "public/js")
    // .extract(['vue'])
    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")]
    })
    .purgeCss();

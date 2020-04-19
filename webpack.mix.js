const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 | 
 */
mix.js("resources/js/dashboard/app.js", "public/js/dashboard/v1_app.js")
    .js("resources/js/site/app.js", "public/js/site/v1_app.js")
    .sass(
        "resources/sass/dashboard/app.scss",
        "public/css/dashboard/v1_app.css"
    )
    .sass("resources/sass/site/app.scss", "public/css/site/v1_app.css");

mix.browserSync({
    proxy: "http://localhost:8000",
    snippetOptions: {
        rule: {
            match: /<\/body>/i,
            fn: function(snippet, match) {
                return snippet + match;
            }
        }
    }
});

//for notification
mix.disableNotifications();

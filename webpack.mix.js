mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .postCss("resources/css/tailwindcss.css", "public/css", [
        require("tailwindcss"),
    ]);

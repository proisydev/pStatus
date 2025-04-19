import mix from "laravel-mix";
import tailwindcss from "@tailwindcss/postcss";
import autoprefixer from "autoprefixer";

mix.js("resources/js/app.js", "public/assets/js")
    .postCss("resources/css/app.css", "public/assets/css", [
        tailwindcss,
        autoprefixer,
    ])
    .version();

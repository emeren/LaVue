const mix = require("laravel-mix");

//  Backend
mix.js("resources/js/backend.js", "public/backend/js").sass(
    "resources/sass/backend.scss",
    "public/backend/css"
);

// Frontend
mix.js("resources/js/frontend.js", "public/js").sass(
    "resources/sass/frontend/app.scss",
    "public/frontend/css"
);


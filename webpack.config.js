// webpack.config.js
const VueLoaderPlugin = require("vue-loader/lib/plugin");
const path = require("path");

module.exports = {
    mode: "development",
    resolve: {
        alias: {
            "@": path.resolve(__dirname, '"/resources/js/backend/'),
        },
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: "vue-loader",
            },
        ],
    },
    plugins: [
        // make sure to include the plugin for the magic
        new VueLoaderPlugin(),
    ],
};

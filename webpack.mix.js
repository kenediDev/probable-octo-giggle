const mix = require("laravel-mix");
const { VueLoaderPlugin } = require("vue-loader");

mix.js("resources/js/app.ts", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .webpackConfig({
        resolve: {
            extensions: [".ts", ".js"]
        },
        module: {
            rules: [
                {
                    test: /\.vue$/,
                    loader: "vue-loader"
                },
                {
                    test: /\.js$/,
                    use: {
                        loader: "babel-loader",
                        options: {
                            presets: ["@babel/preset-env"]
                        }
                    },
                    exclude: /(node_modules|bower_components)/
                },
                {
                    test: /\.(ts|tsx)$/,
                    loader: "ts-loader",
                    options: {
                        appendTsSuffixTo: [/\.vue$/]
                    },
                    exclude: /(node_modules|bower_components)/
                },
                {
                    test: /\.(png|jpg|gif)$/i,
                    use: [
                        {
                            loader: "url-loader",
                            options: {
                                limit: 8192
                            }
                        }
                    ]
                },
                {
                    test: /\.html$/,
                    loader: "html-loader"
                },
                {
                    test: /\.less$/,
                    use: [
                        "vue-style-loader",
                        "css-loader",
                        {
                            loader: "less-loader",
                            options: {
                                javascriptEnabled: true
                            }
                        }
                    ]
                }
            ]
        },
        plugins: [new VueLoaderPlugin()]
    });

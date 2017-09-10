module.exports = {
    entry: {
        app: './javascript/app/app.js'
    },
    output: {
        filename: './javascript/dist/[name].bundle.js'
    },
    resolve: {
        modules: [
            '../../node_modules'
        ]
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader?presets[]=es2015'
                }
            }
        ]
    }
};
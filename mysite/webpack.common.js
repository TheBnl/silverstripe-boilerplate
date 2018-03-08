const path = require('path');
const webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
  entry: {
    app: './javascript/app/app.js'
  },
  optimization: {
    splitChunks: {
      chunks: 'initial',
      name: 'vendor'
    }
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery"
    })
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      }
    ]
  },
  output: {
    path: path.resolve(__dirname, 'javascript/dist'),
    filename: '[name].bundle.js'
  },
};
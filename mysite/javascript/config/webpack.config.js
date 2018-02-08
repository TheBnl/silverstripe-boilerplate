const webpack = require('webpack');

module.exports = {
  config: {
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
    plugins: [
      new webpack.optimize.CommonsChunkPlugin({
        name: "vendor"
      })
    ],
    module: {
      rules: [
        {
          test: /\.js$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['es2015'],
              comments: false
            }
          }
        }
      ]
    }
  },

  get: function(build) {
    if (build) {
      this.config.plugins.push(new webpack.optimize.UglifyJsPlugin());
    }

    return this.config;
  }
};

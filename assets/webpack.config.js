const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const cssnano = require( 'cssnano' ); // https://cssnano.co/
// const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
const TerserPlugin = require("terser-webpack-plugin");
const CopyPlugin = require('copy-webpack-plugin'); // https://webpack.js.org/plugins/copy-webpack-plugin/
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );
const path = require('path');

const JS_DIR = path.resolve(__dirname, '/src/js');
const IMG_DIR = path.resolve(__dirname, '/src/img');
const LIB_DIR = path.resolve( __dirname, 'src/library' );
const BUILD_DIR = path.resolve(__dirname, 'build');

const entry = {
  main: JS_DIR + '/main.js',
  single: JS_DIR + '/single.js',
  editor: JS_DIR + '/editor.js',
	blocks: JS_DIR + '/blocks.js',
	author: JS_DIR + '/author.js',
};

const output = {
  path: BUILD_DIR,
  filename: 'js/[name].js'
};

/**
 * Note: argv.mode will return 'development' or 'production'.
 */
const plugins = ( argv ) => [
	new CleanWebpackPlugin( {
		cleanStaleWebpackAssets: ( 'production' === argv.mode  ) // Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
	} ),

	new MiniCssExtractPlugin( {
		filename: 'css/[name].css'
	} ),

	new CopyPlugin( {
		patterns: [
			{ from: LIB_DIR, to: BUILD_DIR + '/library' }
		]
	} ),

	new DependencyExtractionWebpackPlugin( {
		injectPolyfill: true,
		combineAssets: true,
	} )
];

const rules = [
  {
    test: /\.js$/,
    include: [ JS_DIR ],
    exclude: /node_modules/,
    use: 'babel-loader'
  },
  {
    test: /\.(sc|s)ss$/i,
    exclude: /node_modules/,
    use: [
      MiniCssExtractPlugin.loader,
      'css-loader',
      'sass-loader',
    ],
  },
  {
    test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
    use: [
      {
        loader: 'file-loader',
        options: {
          name: '[path][name].[ext]',
          publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../', 
        }
      },
    ],
  },
  {
		test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
		exclude: [ IMG_DIR, /node_modules/ ],
		use: {
			loader: 'file-loader',
			options: {
				name: '[path][name].[ext]',
				publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
			}
		}
	}
];

/**
 * Since you may have to disambiguate in your webpack.config.js between development and production builds,
 * you can export a function from your webpack configuration instead of exporting an object
 *
 * @param {string} env environment ( See the environment options CLI documentation for syntax examples. https://webpack.js.org/api/cli/#environment-options )
 * @param argv options map ( This describes the options passed to webpack, with keys such as output-filename and optimize-minimize )
 * @return {{output: *, devtool: string, entry: *, optimization: {minimizer: [*, *]}, plugins: *, module: {rules: *}, externals: {jquery: string}}}
 *
 * @see https://webpack.js.org/configuration/configuration-types/#exporting-a-function
 */

module.exports = ( env, argv) => ({
  entry: entry,
  output: output,
  devtool: 'source-map',
  module: {
    rules: rules,
  },
  optimization: {
    // splitChunks: {
    //   chunks: 'all',
    // },
    minimize: true,
    minimizer: [ 
      new CssMinimizerPlugin({
        minimizerOptions: {
          preset: require.resolve("cssnano"),
        },
      }),
      // `...`, new CssMinimizerPlugin(),
      new TerserPlugin({
        test: /\.js(\?.*)?$/i,
      })
    ],
  },
  plugins: plugins( argv ),
  externals: {
    jquery: 'jQuery'
  }
});
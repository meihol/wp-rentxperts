const defaultConfig = require("@wordpress/scripts/config/webpack.config");
// Import the helper to find and generate the entry points in the src directory
const { getWebpackEntryPoints } = require("@wordpress/scripts/utils/config");
const path = require("path");

module.exports = {
  ...defaultConfig,
  externals: {
    react: "React",
    "react-dom": "ReactDOM",
  },
  entry: {
    ...getWebpackEntryPoints(),
    "modules/custom-font/main": "./src/modules/custom-font/main.js",
    "modules/custom-icon/main": "./src/modules/custom-icon/main.js",
    "modules/cpt-builder/main": "./src/modules/cpt-builder/main.js",
    "modules/animation-builder/main": "./src/modules/animation-builder/main.js",
  },
  output: {
    path: path.resolve(__dirname, "assets/build"), // Custom output directory
    filename: "[name].js", // Output bundle filename
    // publicPath: "/assets/", // Public URL of the output directory when referenced in a browser
  },
  module: {
    ...defaultConfig.module,
    rules: [
      ...defaultConfig.module.rules,
      // Additional rules can be added here
    ],
  },
  plugins: [
    ...defaultConfig.plugins,
    // Additional plugins can be added here
  ],
  resolve: {
    extensions: [".js", ".jsx"],
    modules: [path.resolve(__dirname, "/src"), "node_modules"],
    alias: {
      "@": path.resolve(__dirname, "src/modules/animation-builder/"),
      S: path.resolve(__dirname, "src/modules/cpt-builder/"),
    },
  },
};

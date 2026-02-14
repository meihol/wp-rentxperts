const tailwindAnimBuilder = require("./tailwind.animBuilder.config.js");
const tailwindCptBuilder = require("./tailwind.cptBuilder.config.js");

module.exports = {
  plugins: {
    "postcss-nested": {},
    tailwindcss: { tailwindAnimBuilder },
    tailwindcss: { tailwindCptBuilder },
    autoprefixer: {},
  },
};

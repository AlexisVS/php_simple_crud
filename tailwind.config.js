const colors = require('tailwindcss/colors')
module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./Views/**/*.{php,html}",
    "./Views/**/*.php",
    "./public/index.php"
  ],
  dakMode: 'class',
  theme: {
    extend: {
    },
  },
  plugins: [],
}

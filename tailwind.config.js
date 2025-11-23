/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        brownBase: "#AF8F6F",
        brownDark: "#543310",
        brownHover: "#8b6a4b",
      },
    },
  },
  plugins: [],
}

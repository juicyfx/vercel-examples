module.exports = {
  purge: [
    './resources/js/**/*.vue'
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Inter', 'Helvetica', 'Arial', 'sans-serif']
      },
      screens: {
        'dark-mode': { raw: '(prefers-color-scheme: dark)' }
      }
    },
  },
  variants: {},
  plugins: [],
}

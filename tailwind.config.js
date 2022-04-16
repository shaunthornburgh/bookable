module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: { sans: ['Inter var'] },
      spacing: {
        '72': '18rem',
        '80': '20rem',
      },
      padding: {
        '5/6': '83.3333333%'
      }
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ]
}

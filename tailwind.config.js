module.exports = {
  purge: [
    './resources/**/*.{php,vue}',
    './resources/**/**/*.{php,vue}',
    './resources/**/**/**/*.{php,vue}'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}

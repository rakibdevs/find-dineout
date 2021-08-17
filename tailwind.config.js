module.exports = {
  purge: [
    './resources/**/*.{php,vue,js,ts,jsx,tsx}',
    './resources/**/**/*.{php,vue,js,ts,jsx,tsx}',
    './resources/**/**/**/*.{php,vue,js,ts,jsx,tsx}'
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

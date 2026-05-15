/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.html'],
  theme: {
    extend: {
      colors: {
        carbon: '#0F1115',
        bone: '#F4F3EF',
        green: '#1F3D2B',
        gunmetal: '#3A3F45',
        bronze: '#C5A37D',
      },
      fontFamily: {
        heading: ['Poppins', 'system-ui', 'sans-serif'],
        sans: ['Poppins', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
};

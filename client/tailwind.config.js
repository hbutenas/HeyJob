/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./nuxt.config.{js,ts}",
    "./node_modules/flowbite/**/*.{js,ts}"
  ],
  theme: {
    extend: {
      textColor: {
        primary: '#FFFFFF', // Primary Text Color: White
        secondary: '#B0B0B0',  // Secondary Text Color: Light Grey
        accent: '#FF6F61',  // Accent Color: Coral
        alternatePrimary: '#000000',  // Alternate Primary Color: Black
        alternateSecondary: '#2C3E50'  // Alternate Secondary Color: Dark Grey
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}


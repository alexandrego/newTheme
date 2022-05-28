module.exports = {
  content: ["./src/**/*.tsx"],
  theme: {
    extend: {
      colors: {
        brand: {
          300: '#996DFF',
          500: '#8257e6',
        },
        backgroundHeader: {
          300: '#120A8F'
        },
        icons: {
          300: '#0985F2'
        },
        menuText: {
          300: '#B3BCC5'
        },
        backgroundInput: {
          300: '#F7F7F7'
        },
        confirmation: {
          300: '#92C38A'
        },
        warning: {
          300: '#ED5565'
        }
      },
      borderRadius: {
        md: '4px',
      },
      width: {
        '42': '10.687rem',
        '25': '6.588rem',
        '250': '33.25rem'
      },
      spacing: {
        '138': '8.625rem',
        '400': '25rem',
        '450': '28.125rem',
        '500': '31.25rem',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('tailwind-scrollbar'),
  ],
}

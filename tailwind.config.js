/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
      theme: {
        extend: {
            colors: {
            primary: 'var(--color-primary)',
            secondary: 'var(--color-secondary)',
            negative: 'var(--color-negative)',
            positive: 'var(--color-positive)',
            'primary-background': 'var(--background-primary)',
            'sec-background': 'var(--background-sec)',
            'primary-text': 'var(--color-text-primary)',
                      },
            },
        backgroundColor: (theme) => ({
          ...theme('colors'),
        }),
        borderColor: (theme) => ({
          ...theme('colors'),
        }),
      },
      variants: {
        backgroundColor: ['active'],
        borderStyle: ['responsive'],
      },
      plugins: [],
    }

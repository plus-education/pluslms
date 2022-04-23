const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './storage/framework/views/*.php', 
        './resources/views/**/*.blade.php', 
        './resources/js/**/*.vue'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
    ],
};

const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './database/seeders/seeds/page/*.html'
        ],
        safelist: [
            'md:mt-20',
            'mt-16',
        ]
    },

    theme: {
        extend: {},
    },

    variants: {
        extend: {},
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};

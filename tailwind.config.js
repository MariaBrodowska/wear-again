import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                moveBackground: {
                    '0%': { backgroundPosition: '100% 0%' },
                    '100%': { backgroundPosition: '0% 100%' },
                },
                moveBackground2: {
                    '0%': { backgroundPosition: '0% 100%' },
                    '100%': { backgroundPosition: '100% 0%' },
                },

            },
            animation: {
                moveBackground: 'moveBackground 20s linear infinite',
                moveBackground2: 'moveBackground2 25s linear infinite',
            },
        },
    },
    plugins: [
        forms,
    ],
};

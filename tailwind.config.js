import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            "colors": {
                "primary": {
                    50: "#FFF8EB",
                    100: "#FEEECD",
                    200: "#FEDB95",
                    300: "#FDC659",
                    400: "#FCA903",
                    500: "#DA9403",
                    600: "#C98703",
                    700: "#B07602",
                    800: "#8D5F02",
                    900: "#654401",
                    950: "#4B3301"
                }
              }
        },
    },

    plugins: [forms, typography],
};

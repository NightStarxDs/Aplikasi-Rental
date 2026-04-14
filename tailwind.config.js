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
            colors:{
                neutral:{
                    secondary:{
                        soft: 'rgb(213, 213, 213)',
                    },

                    primary:{
                        dark: '#073f2c',
                        medium: '#FFFF',
                    },

                    tertiary: '#305d49',
            }
            }
            
        },
    },

    plugins: [
        require('flowbite/plugin'),    
        forms,
    ],
};

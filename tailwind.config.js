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
            keyframes: {
            marquee: {
                '0%':   { transform: 'translateX(0%)' },
                '100%': { transform: 'translateX(-50%)' },
            },
        },

            animation: {
            marquee: 'marquee 25s linear infinite',
        },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'surface': '#022c22',
                'primary': '#064e3b',
                'secondary': '#065f46', 
                'accent': '#10b981',     
                'text-main': '#f0fdf4',  
                'text-sub': '#a7f3d0',   
                'border-color': '#065f46', 
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

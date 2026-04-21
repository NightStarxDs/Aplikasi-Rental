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
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                'auth-panel-slide-to-right': {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(100%)' },
                },
                'auth-panel-slide-to-left': {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(-100%)' },
                },
                'auth-fade-in': {
                    from: { opacity: '0', transform: 'translateY(0.5rem)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
                'auth-fade-out': {
                    from: { opacity: '1', transform: 'translateY(0)' },
                    to: { opacity: '0', transform: 'translateY(-0.25rem)' },
                },
            },

            animation: {
                marquee: 'marquee 25s linear infinite',
                'auth-panel-right': 'auth-panel-slide-to-right 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                'auth-panel-left': 'auth-panel-slide-to-left 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                'auth-fade-in': 'auth-fade-in 0.45s ease-out forwards',
                'auth-fade-out': 'auth-fade-out 0.35s ease-in forwards',
            },

            boxShadow: {
                'auth-card': '0 8px 40px rgba(6, 78, 59, 0.10)',
            },

            minHeight: {
                'auth-card': '520px',
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                auth: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                surface: '#022c22',
                primary: '#064e3b',
                secondary: '#065f46',
                accent: '#10b981',
                'text-main': '#f0fdf4',
                'text-sub': '#a7f3d0',
                'border-color': '#065f46',
                neutral: {
                    secondary: {
                        soft: 'rgb(213, 213, 213)',
                    },
                    primary: {
                        dark: '#073f2c',
                        medium: '#FFFF',
                    },
                    tertiary: '#305d49',
                },
            },
        },
    },

    plugins: [require('flowbite/plugin'), forms],
};

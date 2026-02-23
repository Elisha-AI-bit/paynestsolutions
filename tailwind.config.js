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
                display: ["Outfit", "Inter", "sans-serif"],
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": {
                    DEFAULT: "#0f172a", // Deep Navy
                    vibrant: "#1e293b",
                    light: "#334155",
                },
                "accent": {
                    DEFAULT: "#10b981", // Emerald
                    hover: "#059669",
                },
                "surface": "#f8fafc",
                "glass": "rgba(255, 255, 255, 0.7)",
            },
            borderRadius: {
                "DEFAULT": "0.5rem",
                "lg": "0.75rem",
                "xl": "1.25rem",
                "2xl": "2rem",
            },
        },
    },

    plugins: [forms],
};

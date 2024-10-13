import preset from './vendor/filament/support/tailwind.config.preset'
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        "./storage/framework/views/*.php",
        "./vendor/filament/**/*.blade.php",
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: "class",
    theme: {
        extend: {
            backgroundImage: {
                "gradient-overlay":
                    "linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1))",
                "gradient-overlay-dark":
                    "linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1))",
            },
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                hero: ["Bebas Neue", "serif"],
                heading: ["Playfair Display", "serif"],
                lobster: ["Lobster", "serif"],
            },
            colors: {
                primary: "#263238",
                secondary: "#00b7eb",
                accent: "#00ced1",
                neutral: "#334155",
                "base-light": "#ffff",
                "base-dark": "#37474F",
                info: "#77b5fe",
                success: "#4ade80",
                warning: "#facc15",
                error: "#f87171",
            },
            animation: {
                fadeInUp: "fadeInUp 0.9s ease-out",
                fadeInDown: "fadeInDown 0.9s ease-out",
                slideInRight: "slideInRight 0.9s ease-out",
                slideInLeft: "slideInLeft 0.9s ease-out",
                scaleIn: "scaleIn 0.3s ease-out",
                blob: "blob 1s ease-in-out infinite",
                subtleHover: "subtleHover 0.3s ease-in-out forwards",
                bounceIn: "bounceIn 0.8s ease-out",
                fadeInScale: "fadeInScale 1s ease-out",
                tiltHover: "tiltHover 0.3s ease-in-out both",
                textPop: "textPop 0.2s ease-out",
            },
            keyframes: {
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(10px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                fadeInDown: {
                    "0%": { opacity: "0", transform: "translateY(-10px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                slideInRight: {
                    "0%": { transform: "translateX(100%)" },
                    "100%": { transform: "translateX(0)" },
                },
                slideInLeft: {
                    "0%": { transform: "translateX(-100%)" },
                    "100%": { transform: "translateX(0)" },
                },
                scaleIn: {
                    "0%": { transform: "scale(0.95)" },
                    "100%": { transform: "scale(1)" },
                },
                blob: {
                    "0%": { transform: "translate(0, 0) scale(1)" },
                    "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                    "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                    "100%": { transform: "translate(0, 0) scale(1)" },
                },
                subtleHover: {
                    "0%": { transform: "translateY(0)" },
                    "100%": { transform: "translateY(-5px)" },
                },
                bounceIn: {
                    "0%": { transform: "scale(0.8)", opacity: 0 },
                    "100%": { transform: "scale(1)", opacity: 1 },
                },
                fadeInScale: {
                    "0%": { opacity: 0, transform: "scale(0.95)" },
                    "100%": { opacity: 1, transform: "scale(1)" },
                },
                tiltHover: {
                    "0%, 50%, 100%": { transform: "rotate3d(0, 0, 1, 0deg)" },
                    "25%": { transform: "rotate3d(0, 0, 1, -3deg)" },
                    "75%": { transform: "rotate3d(0, 0, 1, 3deg)" },
                },
                textPop: {
                    "0%": { transform: "scale(1)" },
                    "50%": { transform: "scale(1.1)" },
                    "100%": { transform: "scale(1)" },
                },
                bounceX: {
                    "0%": { transform: "translateX(-25%)", },
                    "50%": { transform: "none", },
                    "100%": {
                        transform: "translateX(-5px)"
                    }
                },
                boxShadow: {
                    card: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)",
                    button: "0 2px 4px 0 rgba(0, 0, 0, 0.2)",
                },
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    sm: "2rem",
                    lg: "4rem",
                    xl: "5rem",
                    "2xl": "6rem",
                },
            },
            screens: {
                xs: "480px",
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1536px",
                "3xl": "1920px",
            },
        },

        plugins: [forms, daisyui],
        daisyui: {
            themes: ["light", "corporate"],
        },
    }
}

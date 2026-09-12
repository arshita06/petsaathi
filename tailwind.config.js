import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**
 * PetSaathi admin theme.
 *
 * The admin panel is built entirely from Tailwind utility classes, so instead
 * of rewriting thousands of class names we remap the colour families it already
 * uses onto the storefront palette from public/assets/css/style.css:
 *
 *   --primary #7c3cff   --pink #ff66aa   --orange #ff8a5b
 *   --ink     #191429   --muted #706a83  --line   #eadfff   --soft #fbf7ff
 *
 *   blue / indigo  -> PetSaathi purple            (primary, links, active nav)
 *   slate / gray   -> lavender-tinted neutrals    (text, surfaces, borders)
 *   rose / red     -> brand pink / danger         (destructive actions, errors)
 *   emerald/green  -> storefront success green    (active badges, success alerts)
 *   amber          -> storefront warning orange   (warnings, pending states)
 *
 * Semantic meaning is preserved (green = success, red/pink = danger) so the
 * panel stays readable; only the hues shift onto the brand.
 */

// Primary — built around --primary #7c3cff. 600 is the main button colour.
const purple = {
    50: '#f5f0ff',
    100: '#ece1ff',
    200: '#dcc9ff',
    300: '#c4a6ff',
    400: '#a578ff',
    500: '#8b4dff',
    600: '#7c3cff', // --primary
    700: '#6a28e6',
    800: '#5620b8',
    900: '#451c91',
    950: '#2a0f5e',
};

// Neutrals — lavender tinted so surfaces match the storefront's soft purples.
const lavender = {
    50: '#fbf7ff',  // --soft
    100: '#f4eeff',
    200: '#eadfff', // --line
    300: '#d7c8f0',
    400: '#9d93ba',
    500: '#706a83', // --muted
    600: '#5a5470',
    700: '#433d59',
    800: '#2b2540',
    900: '#191429', // --ink
    950: '#0f0b1c',
};

// Danger — anchored on --pink #ff66aa, deepening to the storefront's
// alert-error red (#c32b45) so destructive actions still read as dangerous.
const brandRose = {
    50: '#fff1f5',
    100: '#ffe3ec',
    200: '#ffd3da',
    300: '#ffa8c2',
    400: '#ff80aa',
    500: '#ff66aa', // --pink
    600: '#e8437f',
    700: '#c32b45', // .auth-alert-error text
    800: '#9d2039',
    900: '#7e1b30',
    950: '#490c1a',
};

// Success — from .auth-alert-success (#effaf4 / #bfe9d4 / #127a4f).
const brandGreen = {
    50: '#effaf4',
    100: '#dcf4e7',
    200: '#bfe9d4',
    300: '#8ed7b4',
    400: '#52bd8f',
    500: '#29a271',
    600: '#18885c',
    700: '#127a4f',
    800: '#0f6040',
    900: '#0d4e35',
    950: '#052c1d',
};

// Warning — from --orange #ff8a5b and the storefront's roadmap card
// (#fff8f0 / #ffdcc0 / #b35309).
const brandAmber = {
    50: '#fff8f0',
    100: '#fff0e0',
    200: '#ffdcc0',
    300: '#ffbe8c',
    400: '#ff8a5b', // --orange
    500: '#ef7133',
    600: '#d85f1c',
    700: '#b35309',
    800: '#8f4208',
    900: '#75370b',
    950: '#431c04',
};

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

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

            colors: {
                // Remapped families — every existing bg-blue-600, text-slate-500,
                // border-rose-200 … utility now resolves to a PetSaathi colour.
                blue: purple,
                indigo: purple,
                slate: lavender,
                gray: lavender,
                rose: brandRose,
                red: brandRose,
                emerald: brandGreen,
                green: brandGreen,
                amber: brandAmber,

                // Named brand tokens, for anything new that needs the palette
                // directly rather than through a remapped family.
                brand: {
                    ...purple,
                    DEFAULT: '#7c3cff',
                    pink: '#ff66aa',
                    orange: '#ff8a5b',
                    ink: '#191429',
                    muted: '#706a83',
                    line: '#eadfff',
                    soft: '#fbf7ff',
                },
            },
        },
    },

    plugins: [forms],
};

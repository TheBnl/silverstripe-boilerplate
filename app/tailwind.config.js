// tailwind.config.js
module.exports = {
    purge: [],
    purge: [
        './client/src/**/*.js',
        './client/src/**/*.vue',
        './templates/**/*.ss'
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
}
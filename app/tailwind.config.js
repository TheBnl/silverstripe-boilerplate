module.exports = {
    content: [
        "./client/src/js/**/*.{js,vue}",
        "./templates/**/*.ss",
    ],
    theme: {
        screens: {
            sm: '480px',
            md: '768px',
            lg: '976px',
            xl: '1200px',
            xxl: '1440px',
        },
        
        fontFamily: {
            sans: ['Graphik', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        extend: {
            spacing: {
            '128': '32rem',
            '144': '36rem',
            },
            borderRadius: {
            '4xl': '2rem',
            }
        }
    },
    plugins: [],
}
// tailwind.config.js
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'custom-teal': '#1db1b3',  
            }
        },
    },
    plugins: [],
};

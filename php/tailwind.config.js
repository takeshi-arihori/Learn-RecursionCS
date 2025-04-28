/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{html,js,php}"],
    theme: {
        extend: {
            screens: {
                pc: "1024px", // Define PC breakpoint
            },
        },
    },
    plugins: [],
};

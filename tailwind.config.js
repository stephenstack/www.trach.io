module.exports = {
    // important: true,
    theme: {
        pagination: theme => ({
            // Customize the color only. (optional)
            color: theme('colors.indigo.600'),

            // Customize styling using @apply. (optional)
            wrapper: 'inline-flex shadow rounded',

            // Customize styling using CSS-in-JS. (optional)
            wrapper: {
                'display': 'flex',
                'justify-items': 'center',
            },
        }),
        extend: {
            colors: {
                'blue': {
                    100: '#EDF3FF',
                    200: '#D2E0FF',
                    300: '#B7CEFF',
                    400: '#82A9FF',
                    500: '#4C84FF',
                    600: '#4477E6',
                    700: '#2E4F99',
                    800: '#223B73',
                    900: '#17284D',
                },
            },
            opacity: {
                '0': '0',
                '25': '.25',
                '50': '.5',
                '75': '.75',
                '10': '.1',
                '20': '.2',
                '30': '.3',
                '40': '.4',
                '50': '.5',
                '60': '.6',
                '70': '.7',
                '80': '.8',
                '90': '.9',
                '100': '1',
            },
            spacing: {
                '18': '4.5rem',
            }
        }
    },
    fontFamily: {
        // display: ['Gilroy', 'sans-serif'],
        // body: ['Graphik', 'sans-serif'],
    },
    extend: {
        colors: {
            spacing: {
                '28': '7rem',
                '30': '7.5rem',
            }
        }
    },
    variants: {
        opacity: ['responsive', 'hover'],
        margin: ['responsive', 'hover', 'focus'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    },
    plugins: [
        require('tailwindcss-plugins/pagination'),
    ]
}
//https://tailwindcss.com/docs/customizing-colors/#extending-the-default-palette
//https://javisperez.github.io/tailwindcolorshades/#/?blue=4C84FF&tv=1
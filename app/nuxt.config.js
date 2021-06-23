export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'insure-app',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    'bootstrap-vue'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],
  loading: '~/components/loading.vue',
  loadingIndicator: {
    name: 'nuxt',
    color: '#fff',
    background: '#00546C'
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    '@nuxtjs/dayjs'
  ],
  axios: {
    withCredentials: true,
  },
 
  auth: {
    strategies: {
      
      // 'laravelSanctum': {
      //   provide: 'laravel/sanctum',
      //   url: 'http://localhost',
      //   endpoints: {
      //     login: {
      //       url: '/api/login'
      //     },
      //     logout: {
      //       url: '/api/logout'
      //     },
      //     user: {
      //       url: '/api/user'
      //     },
      //   },
      // }
      'laravelJWT': {
        provider: 'laravel/jwt',
        url: 'http://localhost',
        endpoints: {
          login: {
            url: '/api/auth/login'
          },
          logout: {
            url: '/api/auth/logout'
          },
          user: {
            url: '/api/auth/me'
          },
        },
        token: {
          property: 'access_token',
          maxAge: 60 * 60
        },
        refreshToken: {
          maxAge: 20160 * 60
        },
      },

    },
    redirect: {
      login: '/login', // redirect if user is not login 
      logout: '/', //redirect after login
      callback: '/login', // callback form server api
      home: '/' // set default after login success 
    }
  },
  dayjs: {
    locales: ['th', 'en'],
    defaultLocale: 'th',
    defaultTimeZone: 'Asia/Bangkok',
    plugins: [
      'utc', // import 'dayjs/plugin/utc'
      'timezone' // import 'dayjs/plugin/timezone'
    ] // Your Day.js plugin
  },
  // router: {
  //   middleware: ['auth']
  // },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },
  // server: {
  //   port: "8081"
  // }
}

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    ssr: false,
    modules: [
        'nuxt-graphql-client'
    ],
    dir: {
        pages: 'routes'
    },
    components: {
        dirs: [
            {
                global: true,
                path: "~/pages",
            },
            "~/components"
        ]
    },
    runtimeConfig: {
        public: {
          GQL_HOST: 'http://localhost/graphql' // tmp should switch on live env overwritten by process.env.GQL_HOST
        }
    },
    'graphql-client': {
        // codegen: false
        clients: {
            default: {
                host: 'http://localhost/graphql',
                introspectionHost: 'http://localhost/graphql?introspection=1',
                // corsOptions: {
                //     mode: "same-origin"
                //     // credentials: "include" | "omit" | "same-origin"
                // }
            }
        }
    }
})

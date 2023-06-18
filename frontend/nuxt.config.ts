// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // devtools: { enabled: true },
  $development: {
    modules: ["@sidebase/nuxt-auth", "nuxt-headlessui"],
    auth: {
      origin: "http://localhost:3000/",
    },
    app: {
      head: {
        title: "ТурПрактик",
        meta: [
          { name: "description", content: "Турагенство ТурПрактик" },
          {
            name: "keywords",
            content: "ТурПрактик, Турагенство, Туры",
          },
          { name: "robots", content: "all" },
          { name: "author", content: "greenbabyborn" },
        ],
      },
    },

    css: ["~/assets/css/main.css"],
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
    },
  },
});

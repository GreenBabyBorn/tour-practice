<template>
  <footer class="bg-white dark:bg-gray-900 relative">
    <div
      class="container flex flex-col items-center justify-between px-6 py-8 mx-auto lg:flex-row"
    >
      <a href="#">
        <img
          class="w-auto h-7"
          src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600"
          alt=""
        />
      </a>

      <div
        class="flex flex-wrap items-center justify-center gap-4 mt-6 lg:gap-6 lg:mt-0"
      >
        <NuxtLink
          to="/tours"
          class="text-sm text-gray-600 transition-colors duration-300 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400"
        >
          Горящие туры
        </NuxtLink>

        <NuxtLink
          to="/reviews"
          class="text-sm text-gray-600 transition-colors duration-300 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400"
        >
          Отзывы
        </NuxtLink>
        <NuxtLink
          to="/about"
          class="text-sm text-gray-600 transition-colors duration-300 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400"
        >
          О компании
        </NuxtLink>
      </div>

      <p class="mt-6 text-sm text-gray-500 lg:mt-0 dark:text-gray-400">
        © Copyright 2023 ТурПрактик.
      </p>
    </div>
  </footer>
</template>

<template>
  <header class="fixed inset-x-0 top-0 z-50 backdrop-blur ">
    <nav class="container mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <NuxtLink to="/" class="-m-1.5 p-1.5">
          <span class="sr-only">ТурПрактик</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=900" alt="" />
        </NuxtLink>
      </div>
      <div class="flex lg:hidden">
        <button @click.prevent="handleMenu" type="button"
          class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Открыть меню</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <NuxtLink to="/admin" class="text-sm font-semibold leading-6 text-gray-900">Панель управления</NuxtLink>
        <NuxtLink to="/admin/tours" class="text-sm font-semibold leading-6 text-gray-900">Туры</NuxtLink>
        <NuxtLink to="/admin/reviews" class="text-sm font-semibold leading-6 text-gray-900">Отзывы</NuxtLink>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <NuxtLink v-if="!isLoggedIn" to="/cabinet/login" class="text-sm font-semibold leading-6 text-gray-900">Войти <span
            aria-hidden="true">&rarr;</span></NuxtLink>
        <div v-if="isLoggedIn" class="">
          <Menu as="div" class="relative inline-block text-left">
            <div>
              <MenuButton
                class="inline-flex w-full justify-center rounded-md px-4 py-2 text-sm font-medium focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75">
                {{ user?.name }}
                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5 text-gray-600" aria-hidden="true" />
              </MenuButton>
            </div>

            <transition enter-active-class="transition duration-100 ease-out"
              enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
              leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
              leave-to-class="transform scale-95 opacity-0">
              <MenuItems
                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="px-1 py-1">
                  <MenuItem as="div" v-slot="{ active, close }">
                  <NuxtLink to="/cabinet" @click.prevent="close" :class="[
                    active ? 'bg-green-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]">
                    Личный кабинет
                  </NuxtLink>
                  </MenuItem>
                  <MenuItem v-if="user?.role === 1" as="div" v-slot="{ active, close }">
                  <NuxtLink to="/admin" @click.prevent="close" :class="[
                    active ? 'bg-green-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]">
                    Панель управления
                  </NuxtLink>
                  </MenuItem>
                </div>

                <div class="px-1 py-1">
                  <MenuItem v-slot="{ active }">
                  <button @click.prevent="logout" :class="[
                    active ? 'bg-red-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]">
                    Выход
                  </button>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div :class="{
      'lg:hidden': menuState,
    }" class="" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div :class="{
        'fixed inset-0 z-50': menuState,
      }" class=""></div>
      <div :class="{
        'right-[0%]': menuState,
      }"
        class="min-h-screen transition-all ease duration-500 fixed inset-y-0 right-[-100%] z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <NuxtLink @click="handleMenu()" to="/" class="-m-1.5 p-1.5">
            <span class="sr-only">ТурПрактик</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600" alt="" />
          </NuxtLink>
          <button @click="handleMenu" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Закрыть меню</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <NuxtLink @click="handleMenu()" to="/admin/tours"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                Горящие туры</NuxtLink>
              <NuxtLink @click="handleMenu()" to="/admin/reviews"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                Отзывы</NuxtLink>
              
            </div>
            <div class="py-6">
              <NuxtLink v-if="!isLoggedIn" to="/cabinet/login" @click="handleMenu()"
                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                Войти</NuxtLink>
              <div v-if="isLoggedIn" class="">
                <NuxtLink @click="handleMenu()"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                  to="/cabinet">
                  Личный кабинет
                </NuxtLink>
                <NuxtLink @click="handleMenu()"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                  to="/admin">
                  Панель управления
                </NuxtLink>
                <button @click.prevent="logout" @click="handleMenu()"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                  Выход
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";

const { user, logout, isLoggedIn } = useAuth();
const menuState = ref(false);
const handleMenu = () => {
  //   console.log(menuState.value);
  menuState.value = !menuState.value;
};


</script>

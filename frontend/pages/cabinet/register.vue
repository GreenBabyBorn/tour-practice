<template>
  <div
    class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        class="mx-auto h-10 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600"
        alt="Your Company"
      />
      <h2
        class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
      >
        Регистрация
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit.prevent="submit">
        <div>
          <label
            for="fio"
            class="block text-sm font-medium leading-6 text-gray-900"
            >ФИО</label
          >
          <div class="mt-2">
            <input
              id="fio"
              name="fio"
              type="text"
              autocomplete="fio"
              required
              v-model="data.name"
              autoFocus
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
            {{ errors.name }}
          </div>
        </div>
        <div>
          <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Электронная почта</label
          >
          <div class="mt-2">
            <input
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required
              v-model="data.email"
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
            {{ errors.email }}
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Пароль</label
            >
          </div>
          <div class="mt-2">
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              v-model="data.password"
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
            {{ errors.password }}
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label
              for="repeat-password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Повторите пароль</label
            >
          </div>
          <div class="mt-2">
            <input
              id="repeat-password"
              name="repeat-password"
              type="password"
              autocomplete="current-password"
              required
              v-model="data.password_confirmation"
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
            {{ errors.password_confirmation }}
          </div>
        </div>

        <div>
          <button
            type="submit"
            :disabled="inProgress"
            class="flex w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
          >
            Зарегистрироваться
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Уже есть аккаунт?
        {{ " " }}
        <NuxtLink
          to="/cabinet/login"
          class="font-semibold leading-6 text-green-600 hover:text-green-500"
          >Войдите!</NuxtLink
        >
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "empty",
  middleware: ["guest"],
});

const router = useRouter();
const { register } = useAuth();

const data = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const {
  submit,
  inProgress,
  validationErrors: errors,
} = useSubmit(() => register(data), {
  onSuccess: () => router.push("/cabinet"),
});
</script>

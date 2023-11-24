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
        Авторизация
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit.prevent="submit">
        <div>
          <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Электронная почта</label
          >
          <div class="mt-2">
            <input
              v-model="data.email"
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required="true"
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
            {{ errors.email?.[0] }}
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Пароль</label
            >
            <!-- <div class="text-sm">
              <a
                href="#"
                class="font-semibold text-green-600 hover:text-green-500"
                >Forgot password?</a
              >
            </div> -->
          </div>
          <div class="mt-2">
            <input
              v-model="data.password"
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required="true"
              class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
            />
          </div>
        </div>

        <div class="block mt-4">
          <label for="remember" class="inline-flex items-center">
            <input
              id="remember"
              type="checkbox"
              name="remember"
              class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
              v-model="data.remember"
            />
            <span class="ml-2 text-sm text-gray-600"> Запомнить меня </span>
          </label>
        </div>
        <div>
          <button
            :disabled="inProgress"
            type="submit"
            class="flex w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
          >
            Войти
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Нет аккаунта?
        {{ " " }}
        <NuxtLink
          to="/cabinet/register"
          class="font-semibold leading-6 text-green-600 hover:text-green-500"
          >Создайте!</NuxtLink
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
const route = useRoute();
const { login } = useAuth();

const data = reactive({
  email: "",
  password: "",
  remember: false,
});
const status = ref(
  (route.query.reset ?? "").length > 0 ? atob(route.query.reset as string) : ""
);

const {
  submit,
  inProgress,
  validationErrors: errors,
} = useSubmit(
  () => {
    status.value = "";
    return login(data);
  },
  {
    onSuccess: () => router.push("/cabinet"),
  }
);
</script>

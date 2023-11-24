<script setup lang="ts">
import {
  Listbox,
  ListboxLabel,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from "@headlessui/vue";
definePageMeta({
  layout: "admin",
  middleware: ["admin"],
});
const route = useRoute();
const { data: user } = await useLarafetch("/api/users/" + route.params.user);

const roles = reactive([
  {
    id: 0,
    name: "Пользователь",
  },
  {
    id: 1,
    name: "Администратор",
  },
]);
const selectedRoles = ref(roles[user.value.role]);

const data = reactive({
  name: user.value.name,
  email: user.value.email,
  role: computed(() => selectedRoles.value.id),
});

const {
  submit: editUser,
  inProgress,
  validationErrors,
} = useSubmit(
  () =>
    $larafetch(`/api/users/${route.params.user}`, {
      method: "put",
      body: data,
    }),
  {
    onSuccess: (result) => {
      // reviewStore.addReview(result)
      console.log("User update successfully", result, data);
    },
  }
);
// const { user } = useAuth();
</script>

<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      Редактирование пользователя
    </h2>
    <form @submit.prevent="editUser()" class="flex flex-col gap-4 mt-10">
      <div class="flex gap-4 flex-col flex-wrap md:flex-row">
        <div class="flex flex-col">
          <InputLabel for="name">Имя</InputLabel>
          <TextInput id="name" name="name" v-model="data.name"></TextInput>
        </div>

        <div class="flex flex-col">
          <InputLabel for="email">Email</InputLabel>
          <TextInput id="email" name="email" v-model="data.email"></TextInput>
        </div>

        <div class="flex flex-col">
          <InputLabel>Роль</InputLabel>
          <Listbox v-model="selectedRoles">
            <div class="relative">
              <ListboxButton
                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus:outline-offset-1 focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-green-500 sm:text-sm"
              >
                <span class="block truncate text-base">{{
                  selectedRoles.name
                }}</span>
                <span
                  class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                >
                </span>
              </ListboxButton>

              <transition
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
              >
                <ListboxOptions
                  class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                >
                  <ListboxOption
                    v-slot="{ active, selected }"
                    v-for="role in roles"
                    :key="role.name"
                    :value="role"
                    as="template"
                  >
                    <li
                      :class="[
                        active
                          ? 'bg-green-100 text-green-900'
                          : 'text-gray-900',
                        'relative cursor-default select-none py-2 px-4',
                      ]"
                    >
                      <span
                        :class="[
                          selected ? 'font-medium' : 'font-normal',
                          'block truncate',
                        ]"
                        >{{ role.name }}</span
                      >
                      <span
                        v-if="selected"
                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                      >
                      </span>
                    </li>
                  </ListboxOption>
                </ListboxOptions>
              </transition>
            </div>
          </Listbox>
        </div>
      </div>

      <PrimaryButton class="self-start">Сохранить</PrimaryButton>
    </form>
  </section>
</template>

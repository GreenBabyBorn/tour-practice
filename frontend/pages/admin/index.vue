<script setup lang="ts">
definePageMeta({
  layout: "admin",
  middleware: ["admin"],
});

const { data: users } = await useLarafetch("/api/users");

const { user } = useAuth();

const userRole = ["Пользователь", "Администратор"];
</script>

<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      Панель управления
    </h2>
    
    <div class="flex flex-col mt-4">
      <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
        Пользователи
      </h3>
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full text-left text-sm font-light">
              <thead class="border-b bg-white font-medium">
                <tr>
                  <th scope="col" class="px-6 py-4">№</th>
                  <th scope="col" class="px-6 py-4">Email</th>
                  <th scope="col" class="px-6 py-4">Имя</th>
                  <th scope="col" class="px-6 py-4">Дата регистрации</th>
                  <th scope="col" class="px-6 py-4">Роль</th>
                  <th scope="col" class="px-6 py-4">Действия</th>
                </tr>
              </thead>
              <tbody v-for="user of users">
                <tr class="border-b bg-neutral-100">
                  <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{ user.id }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">{{ user.email }}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{ user.name }}</td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ new Date(user.created_at).toLocaleString() }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ userRole[user.role] }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    <NuxtLink
                      class="rounded-xl bg-green-400 font-medium py-2 px-4"
                      :to="'/admin/users/' + user.id"
                      >Редактировать</NuxtLink
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

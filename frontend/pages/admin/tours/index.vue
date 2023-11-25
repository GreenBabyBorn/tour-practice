<script setup lang="ts">
import type { File } from '@babel/types';

definePageMeta({
  layout: "admin",
  middleware: ["admin"],
});
const toursStore = useToursStore();
const { data: tours } = await useLarafetch("/api/tours");
toursStore.tours = <Tour[]>tours.value;


const photo = ref()


const data = reactive({
  name: '',
  to: '',
  from: '',
  dateTo: '',
  dateFrom: '',
  cost: '',
});

const {
  submit: createTour,
  inProgress,
  validationErrors,
} = useSubmit(
  () =>
    $larafetch(`/api/tours`, {
      method: "post",
      body: data,
    }),
  {
    onSuccess: async (result) => {

      let formData = new FormData();
      formData.append('photo', photo.value.files[0])
      const { data } = await useLarafetch(`/api/tours/${result.id}/photos`,
        {
          method: "post",
          body: formData,

        })
      const { data: tours } = await useLarafetch("/api/tours");
      toursStore.tours = <Tour[]>tours.value;
      // toursStore.addTour(newTour)
      // $larafetch(`/api/tours/${result.id}/photos`, {
      //   method: "post",
      //   body: formData,

      // })

      console.log("Tour create successfully", result);
    },
  }
);

const deleteTour = (tour: Tour) => {
  $larafetch(`/api/tours/${tour.id}`, {
    method: "delete",
  }).finally(() => {
    toursStore.removeTour(tour)
  })
}
</script>
<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      Управление турами
    </h2>

    <form @submit.prevent="createTour()" class="flex flex-col gap-4 mt-6">
      <div class="flex gap-4 flex-col flex-wrap md:flex-row justify-between">
        <div class="flex flex-col">
          <InputLabel for="name">Название тура</InputLabel>
          <TextInput id="name" name="name" v-model="data.name"></TextInput>
        </div>

        <div class="flex flex-col">
          <InputLabel for="from">Откуда</InputLabel>
          <TextInput id="from" name="from" v-model="data.from"></TextInput>
        </div>
        <div class="flex flex-col">
          <InputLabel for="to">Куда</InputLabel>
          <TextInput id="to" name="to" v-model="data.to"></TextInput>
        </div>
        <div class="flex flex-col">
          <InputLabel for="dateTo">Туда</InputLabel>
          <input
            class="shadow-md focus:outline-green-500 focus:outline-1 focus:outline-offset-0 ou text-base outline-none border-none rounded-lg"
            type="date" id="dateTo" name="dateTo" v-model="data.dateTo">
        </div>
        <div class="flex flex-col">
          <InputLabel for="dateFrom">Оттуда</InputLabel>
          <input
            class="shadow-md focus:outline-green-500 focus:outline-1 focus:outline-offset-0 ou text-base outline-none border-none rounded-lg"
            type="date" id="dateFrom" name="dateFrom" v-model="data.dateFrom">
        </div>
        <div class="flex flex-col">
          <InputLabel for="cost">Стоимость</InputLabel>
          <TextInput id="cost" name="cost" v-model="data.cost"></TextInput>
        </div>
        <div class="flex flex-col">
          <InputLabel for="photo">Фото тура</InputLabel>
          <input  ref="photo" class="mt-2" type="file" name="photo" id="photo">
        </div>

      </div>
      <PrimaryButton class="self-end">Добавить тур</PrimaryButton>
    </form>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5 mb-6 items-center mt-6">
      <div v-for="tour in toursStore.getTours" :key="tour.id" class="flex flex-col gap-y-3 col-span-1">
        <div class="h-60">
          
          <img class="w-full h-full object-cover rounded-lg" :src="tour.photos[0]?.path" alt="" />
        </div>
        <h3 class="text-xl font-semibold sm:text-lg">
          {{ tour.name }}
        </h3>
        <ul class="text-md">
          <li>Вылет: {{ tour.from }}</li>
          <li>Расположение: {{ tour.to }}</li>
          <li>Даты: {{ tour.dateTo }} - {{ tour.dateFrom }}</li>
        </ul>
        <span class="text-xl">от {{ tour.cost }} / чел</span>
        <button @click="deleteTour(tour)"
          class="block w-full rounded-md bg-red-600 px-3.5 py-2.5 text-center text-md font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
          Удалить
        </button>
      </div>
    </div>
  </section>
</template>

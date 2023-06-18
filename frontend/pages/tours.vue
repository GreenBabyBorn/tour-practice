<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2
      class="mb-16 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center"
    >
      Туры
    </h2>
    <div class="flex justify-center pt-5 pb-16">
      <SearchTour></SearchTour>
    </div>
    <div
      class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5 mb-6 items-center"
    >
      <div class="flex flex-col gap-y-3 col-span-1">
        <div class="">
          <img
            class="w-full h-full object-contain rounded-lg"
            src="@/assets/img/637812128069454396.jpeg"
            alt=""
          />
        </div>
        <h3 class="text-xl font-semibold sm:text-lg">
          PREMIER NERGIS BEACH HOTEL & SPA
        </h3>
        <ul class="text-md">
          <li>Вылет: Казань</li>
          <li>Расположение: Турция</li>
          <li>Дата: 20.06.2023</li>
        </ul>
        <span class="text-xl">от 98 838 ₽ / чел</span>
        <button
          type="submit"
          class="block w-full rounded-md bg-green-600 px-3.5 py-2.5 text-center text-md font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
        >
          Забронировать
        </button>
      </div>
    </div>
  </section>
</template>

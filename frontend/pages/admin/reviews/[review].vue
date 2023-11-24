<script setup lang="ts">
definePageMeta({
  layout: "admin",
  middleware: ["admin"],
});
const route = useRoute();
const { data: review } = await useLarafetch(
  `/api/reviews/${route.params.review}`
);

const data = reactive({
  name: review.value.name,
  content: review.value.content,
});

const {
  submit: editReview,
  inProgress,
  validationErrors,
} = useSubmit(
  () =>
    $larafetch(`/api/reviews/${route.params.review}`, {
      method: "put",
      body: data,
    }),
  {
    onSuccess: (result) => {
      // reviewStore.addReview(result)
      console.log("Review update successfully", result, data);
    },
  }
);
// const { user } = useAuth();
</script>

<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      Редактирование отзыва {{ review.id }}
    </h2>
    <form @submit.prevent="editReview()" class="flex flex-col gap-4 mt-10">
      <div class="flex gap-4 flex-col flex-wrap md:flex-row">
        <!-- <div class="flex flex-col">
          <InputLabel for="name">Имя</InputLabel>
          <TextInput id="name" name="name" v-model="data.name"></TextInput>
        </div> -->

        <div class="flex flex-col">
          <InputLabel for="content">Отзыв</InputLabel>

          <textarea
            v-model="data.content"
            name="message"
            id="content"
            rows="4"
            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
          />
        </div>
      </div>

      <PrimaryButton class="self-start">Сохранить</PrimaryButton>
    </form>
  </section>
</template>

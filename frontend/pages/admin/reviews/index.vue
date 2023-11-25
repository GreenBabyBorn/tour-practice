<script setup lang="ts">
definePageMeta({
  layout: "admin",
  middleware: ["admin"],
});
const reviewStore = useReviewsStore();
const { data: reviews } = await useLarafetch("/api/reviews");
reviewStore.reviews = <Review[]>reviews.value;
const deleteReview = (review: Review) => {
  const {
    submit: removeReview,
    inProgress,
    validationErrors,
  } = useSubmit(
    () =>
      $larafetch(`/api/reviews/${review.id}`, {
        method: "delete",
      }),
    {
      onSuccess: (result) => {
        // reviewStore.addReview(result)
        console.log("Review delete successfully", result);
      },
    }
  );
  removeReview();
  reviewStore.removeReview(review);
};
</script>
<template>
  <section class="max-w-6xl mt-24 mx-auto flex flex-col lg:px-8 px-4">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      Управление отзывами
    </h2>
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b bg-white font-medium">
              <tr>
                <th scope="col" class="px-6 py-4">№</th>
                <th scope="col" class="px-6 py-4">Имя</th>
                <th scope="col" class="px-6 py-4">Отзыв</th>
                <th scope="col" class="px-6 py-4">Дата написания</th>
                <th scope="col" class="px-6 py-4">Действия</th>
              </tr>
            </thead>
            <tbody v-for="review of (reviewStore.reviews as Review[])">
              <tr class="border-b bg-neutral-100">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                  {{ review.id }}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{ review.name }}</td>
                <td class="px-6 py-4">
                  {{ review.content }}
                </td>
                <td class="whitespace-nowrap px-6 py-4">
                  {{ new Date(review.created_at).toLocaleString() }}
                </td>
                <td class="whitespace-nowrap px-6 py-4 flex gap-2">
                  <NuxtLink
                    class="rounded-xl bg-green-600 text-white font-medium py-2 px-4"
                    :to="'/admin/reviews/' + review.id"
                    >Редактировать</NuxtLink
                  >
                  <button
                    class="rounded-xl bg-red-600 text-white font-medium py-2 px-4"
                    @click="deleteReview(review)"
                  >
                    Удалить
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

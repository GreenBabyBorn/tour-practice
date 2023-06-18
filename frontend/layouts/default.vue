<template>
  <div class="flex flex-col h-screen justify-between">
    <AppHeader></AppHeader>
    <main class="mb-auto">
      <slot />
    </main>
    <AppFooter></AppFooter>
  </div>
</template>

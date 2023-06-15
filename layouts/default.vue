<template>
  <div class="flex flex-col h-screen justify-between">
    <!-- Markup shared across all pages, ex: NavBar -->
    <AppHeader></AppHeader>
    <main class="mb-auto">
      <slot />
    </main>
    <AppFooter></AppFooter>
  </div>
</template>

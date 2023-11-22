export default defineNuxtRouteMiddleware(async () => {
  const user = useUser();
  if (user.value) return navigateTo("/cabinet", { replace: true });
});

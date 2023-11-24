export default defineNuxtRouteMiddleware(async () => {
  const user = useUser();
  if (user.value.role !== 1)  throw createError({
    statusCode: 404,
    statusMessage: 'Page Not Found'
  });
});

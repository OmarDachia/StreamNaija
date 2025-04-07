<template>
    <div class="min-h-screen flex flex-col">
      <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <router-link to="/" class="mr-4">Home</router-link>
        <router-link to="/dashboard">Dashboard</router-link>
      </nav>
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </template>
  
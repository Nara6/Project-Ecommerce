<template>
  <div class="checkout">
    <h1>This is an checkout page</h1>
    <br />
    <button @click="$emit('cancel')">Cancel</button>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .checkout {
    min-height: 100vh;
  }
}
</style>

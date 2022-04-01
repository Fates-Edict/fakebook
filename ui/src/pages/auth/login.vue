<template>
  <div class="row text-center justify-center">
    <div class="col-11 col-sm-7 col-md-4">
      <q-card style="border-radius: 8px;" class="shadow-6">
        <q-card-section class="text-h6" style="font-weight: normal">Log in to fakebook</q-card-section>
        <q-card-section>
          <q-form autofocus @submit="submit">
            <q-input v-model="dataModel.username" label="Username" outlined />
            <q-input v-model="dataModel.password" label="Password" outlined class="q-my-md" />
            <q-btn type="submit" label="Log In" no-caps color="primary" size="lg" unelevated style="width: 100%; border-radius: 6px;" />
          </q-form>
        </q-card-section>

        <q-separator class="q-my-md" />

        <q-btn label="Create New Account" to="/register" no-caps color="positive" size="lg" class="q-mb-lg" />
      </q-card>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      dataModel: {
        username: null,
        password: null
      }
    }
  },

  methods: {
    submit() {
      alert(`Username: ${this.dataModel.username}, Password: ${this.dataModel.password}`)
    }
  }
}
</script>
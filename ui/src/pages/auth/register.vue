<template>
  <div class="row text-center justify-center">
    <div class="col-11 col-sm-7 col-md-4">
      <q-card style="border-radius: 8px;" class="shadow-6 q-pb-md">
        <q-card-section class="q-pb-none">
          <span class="text-h5 text-bold">Create a new account</span>
          <p class="text-subtitle1 text-grey-8">It's quick and easy.</p>
        </q-card-section>
        <q-separator />
        <q-card-section>
          <q-form autofocus @submit="submit">
            <div class="row q-gutter-xs">
              <q-input dense class="col q-mb-sm" v-model="dataModel.first_name" label="First name" outlined />
              <q-input dense class="col q-mb-sm" v-model="dataModel.surname" label="Surname" outlined />
              <q-input dense class="col-12 q-mb-sm" v-model="dataModel.username" label="Username" outlined />
              <q-input dense class="col-12 q-mb-sm" v-model="dataModel.password" label="Password" outlined />
              <q-input class="col-12 q-mb-sm" label="Date of birth" dense outlined v-model="dataModel.birth_date" mask="##-##-####">
                <template v-slot:append>
                  <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy ref="qDateProxy" cover transition-show="scale" transition-hide="scale">
                      <q-date v-model="dataModel.birth_date" mask="MM-DD-YYYY">
                        <div class="row items-center justify-end">
                          <q-btn v-close-popup label="Close" color="primary" flat />
                        </div>
                      </q-date>
                    </q-popup-proxy>
                  </q-icon>
                </template>
              </q-input>
              <div class="q-gutter-sm q-mx-auto">
                <q-radio v-model="dataModel.gender" checked-icon="r_male" unchecked-icon="panorama_fish_eye" val="0" label="Male" />
                <q-radio v-model="dataModel.gender" checked-icon="r_female" unchecked-icon="panorama_fish_eye" val="1" label="Female" />
              </div>
              <q-btn type="submit" label="Sign Up" no-caps color="primary" size="lg" unelevated style="width: 100%; border-radius: 6px;" />
            </div>
          </q-form>
        </q-card-section>

        <span class="text-subtitle1 text-primary" style="cursor: pointer" @click="$router.push({ name: 'login' })">Already have an account?</span>
      </q-card>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Register',
  data() {
    return {
      dataModel: {
        first_name: null,
        surname: null,
        username: null,
        password: null,
        birth_date: '07-03-1999',
        gender: null
      },
    }
  },

  methods: {
    submit() {
      this.$api.get('generate-key')
      .then((response) => {
        console.log(response)
      })
    }
  }
}
</script>
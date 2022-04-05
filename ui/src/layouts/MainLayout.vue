<template>
  <q-layout view="hHh lpR fFf">

    <q-header unelevated class="bg-white text-primary shadow-up-2 q-pa-xs">
      <q-toolbar class="row">
        <!-- <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" /> -->

        <q-toolbar-title class="col-3 row items-center">
          <transition v-if="isSearch" appear enter-active-class="animated slideInRight">
            <q-btn flat outline round color="grey-7" class="q-mr-sm" icon="arrow_back" @click="isSearch = false" />
          </transition>
          <transition v-else appear enter-active-class="animated slideInLeft">
            <q-avatar style="cursor: pointer" class="q-mr-sm" @click="$route.push({ name: 'home' })">
              <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Facebook_f_logo_%282021%29.svg/225px-Facebook_f_logo_%282021%29.svg.png">
            </q-avatar>
          </transition>

          <q-input borderless dense rounded outlined placeholder="Cari di Fakebook" @click="isSearch = true" bg-color="secondary">
            <template v-slot:prepend>
              <q-icon name="search" />
            </template>
          </q-input>
        </q-toolbar-title>

        <q-tabs class="col-6 row justify-around">
          <q-route-tab class="col" v-for="val in centerMenu" :key="val" :to="val.url">
            <q-icon :name="val.icon" size="md" :color="val.url === $route.path ? 'primary' : 'grey-7'" />
            <q-tooltip class="text-capitalize">{{ val.tooltip }}</q-tooltip>
          </q-route-tab>
        </q-tabs>

        <div class="col-3 row items-center justify-between">
          <q-btn flat color="grey-7" text-color="dark" label="Mutaqin" rounded icon="people" no-caps />
          <q-btn v-for="(val, idx) in rightMenu" :key="idx" round unelevated :color="currentRightMenu == val.tooltip ? 'primary' : 'grey-4'" :text-color="currentRightMenu == val.tooltip ? 'white' : 'dark'" :icon="val.icon" @click="currentMenuCheck(val.tooltip, idx)">
            <q-menu>
              <div class="row no-wrap q-pa-md">
                <div class="column">
                  <div class="text-h6 q-mb-md">Settings</div>
                  <q-toggle v-model="mobileData" label="Use Mobile Data" />
                  <q-toggle v-model="bluetooth" label="Bluetooth" />
                </div>

                <q-separator vertical inset class="q-mx-lg" />

                <div class="column items-center">
                  <q-avatar size="72px">
                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                  </q-avatar>

                  <div class="text-subtitle1 q-mt-md q-mb-xs">John Doe</div>

                  <q-btn color="primary" label="Logout" push size="sm" v-close-popup />
                </div>
              </div>
            </q-menu>

            <q-tooltip class="text-capitalize">{{ val.tooltip }}</q-tooltip>
          </q-btn>
        </div>

        <!-- <q-btn dense flat round icon="menu" @click="toggleRightDrawer" /> -->
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" class="bg-secondary q-py-md">
      <q-list>
        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-avatar color="primary" text-color="white" icon="people" size="md" />
          </q-item-section>

          <q-item-section class="text-capitalize">mutaqin yusuf</q-item-section>
        </q-item>

        <q-item clickable v-ripple v-for="val in leftMenu" :key="val" :to="val.url">
          <q-item-section avatar>
            <q-avatar size="md">
              <img :src="val.imageUrl" />
            </q-avatar>
          </q-item-section>

          <q-item-section class="text-capitalize">{{ val.label }}</q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-drawer show-if-above v-model="rightDrawerOpen" side="right" class="bg-secondary">
      <!-- drawer content -->
    </q-drawer>

    <q-page-container class="bg-secondary">
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script>

const centerMenu = [
  { name: 'home', icon: 'r_home', url: '/', tooltip: 'home' },
  { name: 'watch', icon: 'r_ondemand_video', url: '/watch', tooltip: 'watch' },
  { name: 'store', icon: 'r_storefront', url: '/marketplace', tooltip: 'marketplace' },
  { name: 'group', icon: 'r_groups', url: '/groups', tooltip: 'groups' },
  { name: 'sport', icon: 'r_sports_esports', url: '/gaming', tooltip: 'gaming' }
]

const rightMenu = [
  { icon: 'apps', tooltip: 'menu' },
  { icon: 'question_answer', tooltip: 'messenger' },
  { icon: 'notifications', tooltip: 'notifications' },
  { icon: 'keyboard_arrow_down', tooltip: 'account' }
]

const leftMenu = [
  { label: 'friends', url: '/friends', imageUrl: 'https://static.xx.fbcdn.net/rsrc.php/v3/y8/r/S0U5ECzYUSu.png?_nc_eui2=AeH-nKnAF9S1zyzdvWJy3-aEqfpKmA4GtxSp-kqYDga3FL285B5RsCB5aOirQhO9F0uJsa0JkcB6gSqafQTqD1AF' },
  { label: 'saved', url: '/saved', imageUrl: 'https://static.xx.fbcdn.net/rsrc.php/v3/yD/r/lVijPkTeN-r.png?_nc_eui2=AeHcEJqAWCW2ffZq5uIWWKPL-5kYScafj0T7mRhJxp-PRDlsiNMDfJAqdvixeP7njs3Tl7xuK1pu37mQa_I9JN4D' },
  { label: 'groups', url: '/groups', imageUrl: 'https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/PrjLkDYpYbH.png?_nc_eui2=AeGSBXVJ4Ccaxe-kme60Z9_KZ3xAUM5_bWpnfEBQzn9tahSF8VntopxMmpmktLad8LwJva49-p0A23g2gLcaawK6' },
  { label: 'marketplace', url: '/marketplace', imageUrl: 'https://static.xx.fbcdn.net/rsrc.php/v3/yU/r/D2y-jJ2C_hO.png?_nc_eui2=AeFZHY2NMiu0GQ_cjpGs6ffz-vsl1K9A-9v6-yXUr0D723RkPwJ6ENGuQKbRstHcdGlGpdfWbhHf8LZED4Bd26Zk' },
  { label: 'watch', url: '/watch', imageUrl: 'https://static.xx.fbcdn.net/rsrc.php/v3/y5/r/duk32h44Y31.png?_nc_eui2=AeH4dIvDfLxVO3QCU9dyL9gt2NRDTXGHJ53Y1ENNcYcnnTfuIkL6PtV-QPumv1PKpMugHbXsGFWQ5E4CXZrUuMy8' }
]

export default {
  data() {
    return {
      leftDrawerOpen: true,
      rightDrawerOpen: true,
      centerMenu,
      rightMenu,
      leftMenu,
      currentRightMenu: '',
      isSearch: false
    }
  },

  methods: {
    toggleRightDrawer() {
      this.rightDrawerOpen = !this.rightDrawerOpen
    },

    toggleLeftDrawer() {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },

    currentMenuCheck(menu) {
      if(menu == this.currentRightMenu) this.currentRightMenu = ''
      else if(menu != this.currentRightMenu) {
        this.currentRightMenu = menu
      }
    }
  }
}
</script>
<template>
  <v-app>
    <navigation-bar></navigation-bar>
    <router-view></router-view>
  </v-app>
</template>

<script>

// Component Import
import NavigationBar from '@/components/NavigationBar'

export default {
  name: 'App',

  components: {
      NavigationBar
  },

  data: () => ({
    //
  }),
};
</script>

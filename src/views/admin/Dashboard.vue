<template>
    <v-app>
        <v-content app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row justify="center">
                    <!-- Search Feature -->
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            dense
                            v-model="search"
                            label="Cari Data"
                            prepend-inner-icon="mdi-magnify"
                            :clearable="true"
                            @click:clear="search = ''"
                        ></v-text-field>
                    </v-col>
                    <!-- List -->
                    <!-- Add -->
                    <v-btn fab dark large color="primary" fixed right bottom>
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </v-row>
            </div>
        </v-content>
    </v-app>
</template>

<script>
export default {
    name: 'Dashboard',

    data() {
        return {
            search:''
        }
    }
}
</script>

<style>

</style>
<template>
    <v-app>
        <v-content app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            dense
                            v-model="advanceSearch.name"
                            label="Cari Data"
                            prepend-inner-icon="mdi-magnify"
                            :clearable="true"
                            @click:clear="search = ''"
                        ></v-text-field>
                    </v-col>
                </v-row>
            </div>
        </v-content>
    </v-app>
</template>

<script>
export default {
    name:'AdminAgent',

    data() {
        return {
            advanceSearch: {
                name:''
            }
        }
    }
}
</script>

<style>

</style>
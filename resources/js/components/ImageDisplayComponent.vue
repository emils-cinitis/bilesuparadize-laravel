<template>
    <div class="container">
        <div class="row">
            <div 
                class="col-6"
                :class="{'offset-3': !generatedImage}"
            >
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">All given images:</h3>
                    </div>
                    <div v-for="(image, index) in images" :key="index" class="col-2-4">
                        <img :src="image" alt="Example image" />
                    </div>
                </div>
            </div>
            <div class="col-6" v-if="!!generatedImage">
                <div class="col-12">
                    <h3 class="text-center">Generated image:</h3>
                </div>
                <img :src="generatedImage" alt="Generated image" />
            </div>
        </div>
        <div class="row">
            <div class="col-4 offset-4 text-center pt-3">
                <button class="btn btn-success" v-on:click="generateImage()">Generate</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                images: null,
                generatedImage: null,
            }
        },
        mounted() {
            axios.get('/api/allImages').then((response) => {
                this.images = response.data.images;
            });
        },
        methods: {
            generateImage() {
                this.generatedImage = null;
                axios.post('/api/generate').then((response) => {
                    this.generatedImage = response.data.path;
                });
            },
        },
    }
</script>

<style lang="scss" scoped>
    * {
        font-family: 'Roboto', sans-serif;
    }
    img {
        width: 100%;
        height: auto;
    }

    .col-2-4{
        flex: 0 0 20%;
        max-width: 20%;
    }
    
    .container {
        padding-top: 40px;
    }
</style>

<template>
    <div class="contact-map-cover mb-3">
        <button class="btn btn-outline-success my-3"
                :disabled="loading"
                v-on:click="savePointCoordinates">
            Обновить координаты метки <i class="fas fa-spinner fa-spin" v-if="loading"></i>
        </button>
        <div id="map"></div>
    </div>
</template>

<script>
    export default {
        props: {
            saveCoordUrl: String,
            enterPointCoord: Array,
            icoPreset: String,
        },
        data() {
            return {
                map: false,
                point: false,
                loading: false
            }
        },
        methods: {
            initMap () {
                // Создание карты.
                this.map = new ymaps.Map("map", {
                    center: this.enterPointCoord,
                    zoom: 14,
                    controls: ['smallMapDefaultSet']
                }, {
                    searchControlProvider: 'yandex#search'
                });

                let pointToEvent = this.point = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: this.enterPointCoord
                    }
                }, {
                    draggable: true,
                    preset: this.icoPreset
                });

                this.map.events.add('click', function (e) {
                    pointToEvent.geometry.setCoordinates(e.get('coords'));
                });

                this.map.geoObjects.add(this.point);
            },

            savePointCoordinates () {
                this.loading = true;
                axios
                    .post(this.saveCoordUrl, {
                        coord: this.pointCoord
                    })
                    .then(response => {
                        let result = response.data;
                        if (!result.success) {
                            alert("Что-то пошло не так");
                        }
                    })
                    .catch(error => {
                        let data = error.response.data;
                        if (data.errors.length) {
                            console.log(data.errors);
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },
        computed: {
            pointCoord: function () {
                return this.point.geometry.getCoordinates();
            }
        },
        mounted() {
            ymaps.ready(this.initMap);
        }
    }
</script>

<style scoped>
    #map {
        width: 100%;
        height: 400px;
    }
</style>
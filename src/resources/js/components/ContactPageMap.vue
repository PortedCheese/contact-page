<template>
    <div id="page-map" class="mb-3"></div>
</template>

<script>
    export default {
        props: ['enterPointCoordinates', 'pointsInfo'],
        data() {
            return {
                points: [],
                map: false
            }
        },
        methods: {
            initMap () {
                // Создание карты.
                let pageMap = this.map = new ymaps.Map("page-map", {
                    center: this.enterPointCoordinates,
                    zoom: 14,
                    controls: ['smallMapDefaultSet']
                }, {
                    searchControlProvider: 'yandex#search'
                });

                // Создание меток.
                for (let index in this.pointsInfo) {
                    let point = this.pointsInfo[index];
                    let pointObject = new ymaps.Placemark(point.coord, {
                        balloonContentHeader: point.title,
                        balloonContentBody: point.description
                    });
                    this.points[point.id] = pointObject;
                    this.map.geoObjects.add(pointObject);
                }

                // Перемещение по меткам.
                let pointsCoordinates = this.pointsInfo;
                $('.move-center').each(function (index, element) {
                    $(element).on('click', function() {
                        let id = $(this).attr('data-id');
                        let coordinates = pointsCoordinates[id].coord;
                        pageMap.setCenter(coordinates, 14, {
                            duration: 400
                        });

                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#page-map").offset().top
                        }, 1000);
                    });
                });
            }
        },
        mounted() {
            ymaps.ready(this.initMap);
        }
    }
</script>

<style scoped>
    #page-map {
        width: 100%;
        height: 250px;
    }
</style>
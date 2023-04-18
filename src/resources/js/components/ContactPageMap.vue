<template>
    <div id="page-map" :style="'height: ' + mapSize + 'px;'"></div>
</template>

<script>
    export default {
        props: ['enterPointCoordinates', 'pointsInfo', 'mapSize', 'mapZoom', 'icoPreset'],
        data() {
            return {
                points: [],
                map: false,
                isLoaded: false
            }
        },
        created () {
          window.addEventListener('scroll', this.handleScroll);
        },
        unmounted () {
          window.removeEventListener('scroll', this.handleScroll);
        },
        methods: {
            handleScroll (event) {
              if (window.scrollY > document.getElementById('page-map').offsetTop - this.mapSize
                  && ! this.isLoaded) {
                ymaps.ready(this.initMap);
                this.isLoaded = true
              }
            },
            initMap () {
                // Создание карты.
                let pageMap = this.map = new ymaps.Map("page-map", {
                    center: this.enterPointCoordinates,
                    zoom: this.mapZoom,
                    controls: ['smallMapDefaultSet']
                }, {
                    searchControlProvider: 'yandex#search'
                });
                pageMap.behaviors.disable('scrollZoom');

                // Создание меток.
                for (let index in this.pointsInfo) {
                    let point = this.pointsInfo[index];
                    let ico = this.icoPreset === "noIco" ? point.ico : this.icoPreset;
                    let pointObject = new ymaps.Placemark(point.coord, {
                        balloonContentHeader: point.title,
                        balloonContentBody: point.description
                    }, {
                        preset: ico
                    });

                    this.points[point.id] = pointObject;
                    this.map.geoObjects.add(pointObject);
                }

                // Перемещение по меткам.
                let pointsCoordinates = this.pointsInfo;
                let pointsObjects = this.points;
                $('.move-center').each(function (index, element) {
                    $(element).on('click', function() {
                        let id = $(this).attr('data-id');
                        let coordinates = pointsCoordinates[id].coord;
                        pageMap.setCenter(coordinates, this.zoom, {
                            duration: 400
                        }).then(function () {
                            pointsObjects[id].balloon.open();
                        });

                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#page-map").offset().top
                        }, 1000);
                    });
                });
            },
        },
        mounted() {

        }
    }
</script>

<style scoped>
    #page-map {
        width: 100%;
    }
</style>

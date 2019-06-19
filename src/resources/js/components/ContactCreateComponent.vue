<template>
    <div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   id="pills-info-tab"
                   data-toggle="pill"
                   href="#pills-info"
                   role="tab"
                   aria-controls="pills-info"
                   aria-selected="true">
                    Контакты
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   id="pills-map-tab"
                   data-toggle="pill"
                   href="#pills-map"
                   role="tab"
                   aria-controls="pills-map"
                   aria-selected="false">
                    Карта
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   id="pills-work-tab"
                   data-toggle="pill"
                   href="#pills-work"
                   role="tab"
                   aria-controls="pills-work"
                   aria-selected="false">
                    Рабочие дни
                </a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade"
                 id="pills-map"
                 role="tabpanel"
                 aria-labelledby="pills-map-tab">
                <contact-map :save-coord-url="saveCoordUrl"
                             :ico-preset="icoPreset"
                             :enter-point-coord="enterPointCoord">
                </contact-map>
            </div>
            <div class="tab-pane fade"
                 id="pills-work" role="tabpanel" aria-labelledby="pills-work-tab">
                <work-time :work-times="workTimes"
                           :save-days-url="saveDaysUrl">
                </work-time>
            </div>
            <div class="tab-pane fade show active"
                 id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                <contact-info :links-data="linksData"
                              :save-links-url="saveLinksUrl">
                </contact-info>
            </div>
        </div>

    </div>
</template>

<script>
    import ContactMapComponent from './ContactMapComponent'
    import ContactWorkTimeComponent from './ContactWorkTimeComponent'
    import ContactInfoComponent from './ContactInfoComponent'

    export default {
        components: {
            'contact-map': ContactMapComponent,
            'work-time': ContactWorkTimeComponent,
            'contact-info': ContactInfoComponent
        },
        props: {
            saveCoordUrl: String,
            enterPointCoord: Array,
            workTimes: Array,
            saveDaysUrl: String,
            linksData: Object,
            saveLinksUrl: String,
            icoPreset: String
        },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
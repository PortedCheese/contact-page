<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active"
                       id="pills-info-tab"
                       data-bs-toggle="pill"
                       data-bs-target="#pills-info"
                       role="tab"
                       type="button"
                       aria-controls="pills-info"
                       aria-selected="true">
                        Контакты
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link"
                       id="pills-map-tab"
                       data-bs-toggle="pill"
                       data-bs-target="#pills-map"
                       role="tab"
                       type="button"
                       aria-controls="pills-map"
                       aria-selected="false">
                        Карта
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link"
                       id="pills-work-tab"
                       data-bs-toggle="pill"
                       data-bs-target="#pills-work"
                       type="button"
                       role="tab"
                       aria-controls="pills-work"
                       aria-selected="false">
                        Рабочие дни
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body">
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

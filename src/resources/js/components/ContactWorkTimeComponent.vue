<template>
    <div class="contact-work-time-cover">
        <button class="btn btn-outline-success my-3"
                v-on:click="saveDays"
                :disabled="loading">
            Обновить рабочие дни <i class="fas fa-spinner fa-spin" v-if="loading"></i>
        </button>

        <dl class="row">
            <dt class="col-sm-3">#</dt>
            <dd class="col-sm-9">
                <dl class="row">
                    <dd class="col-sm-6">
                        <div class="btn-group"
                             role="group">
                            <button type="button"
                                    v-on:click="copyWork(false)"
                                    class="btn btn-link">
                                Рабочие
                            </button>
                            <button type="button"
                                    v-on:click="copyWork(true)"
                                    class="btn btn-link">
                                Все
                            </button>
                        </div>
                    </dd>
                    <dd class="col-sm-6">
                        <div class="btn-group"
                             role="group">
                            <button type="button"
                                    v-on:click="copyDiner(false)"
                                    class="btn btn-link">
                                Рабочие
                            </button>
                            <button type="button"
                                    v-on:click="copyDiner(true)"
                                    class="btn btn-link">
                                Все
                            </button>
                        </div>
                    </dd>
                </dl>
            </dd>
            <template v-for="day in days">
                <dt class="col-sm-3">
                    {{ day.name }}
                </dt>
                <dd class="col-sm-9">
                    <dl class="row">
                        <dd class="col-sm-6">
                            <input type="text" v-model="day.workTime">
                        </dd>
                        <dd class="col-sm-6">
                            <input type="text" v-model="day.dinerTime">
                        </dd>
                    </dl>
                </dd>
            </template>
        </dl>
    </div>
</template>

<script>
    export default {
        props: ['workTimes', 'saveDaysUrl'],
        data() {
            return {
                days: [],
                loading: false
            }
        },
        methods: {
            saveDays() {
                console.log(this.days);
                this.loading = true;
                axios
                    .post(this.saveDaysUrl, {
                        days: this.days
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
            },

            copyWork(all) {
                this.copyByKey(all, 'workTime');
            },

            copyDiner(all) {
                this.copyByKey(all, 'dinerTime');
            },

            copyByKey(all, key) {
                let value = this.days[0][key];
                for (let index in this.days) {
                    if (!all && index < 5 || all) {
                        this.days[index][key] = value;
                    }
                }
            }
        },
        created() {
            this.days = this.workTimes;
        }
    }
</script>

<style scoped>

</style>
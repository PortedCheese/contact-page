<template>
    <div class="contact-work-time-cover">
        <button class="btn btn-outline-success my-3"
                v-on:click="saveDays"
                :disabled="loading">
            Обновить рабочие дни <i class="fas fa-spinner fa-spin" v-if="loading"></i>
        </button>

        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="text-center">Рабочее время</th>
                    <th class="text-center">Обед</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Копирование</th>
                    <td>
                        <div class="btn-group btn-block"
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
                    </td>
                    <td>
                        <div class="btn-group btn-block"
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
                    </td>
                </tr>
                <tr v-for="day in days">
                    <th>{{ day.name }}</th>
                    <td>
                        <input class="form-control" type="text" v-model="day.workTime">
                    </td>
                    <td>
                        <input class="form-control" type="text" v-model="day.dinerTime">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
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
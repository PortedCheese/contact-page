<template>
    <div class="contact-info-cover">
        <button class="btn btn-outline-success my-3"
                type="button"
                v-on:click="saveContact"
                :disabled="loading">
            Обновить контакты  <i class="fas fa-spinner fa-spin" v-if="loading"></i>
        </button>

        <div class="phones">
            <h4>Телефоны</h4>

            <div class="input-group mb-3">
                <input type="text"
                       class="form-control"
                       v-model="phone"
                       placeholder="Телефон">
                <div class="input-group-append">
                    <button class="btn btn-outline-success"
                            v-on:click="addPhone"
                            :disabled="phone === ''"
                            type="button">
                        Добавить
                    </button>
                </div>
            </div>

            <div class="input-group mb-3" v-for="(item, index) in phones">
                <div class="input-group-prepend">
                    <div class="btn-group"
                         role="group">
                        <button type="submit"
                                v-if="index >= 1"
                                @click="changeOrder(phones, index, true)"
                                class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button type="submit"
                                v-if="index < phones.length - 1"
                                @click="changeOrder(phones, index, false)"
                                class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                    </div>
                    <label class="input-group-text" :for="'phone-' + index">
                        {{ item.value }}
                    </label>
                </div>
                <input type="text"
                       :id="'phone-' + index"
                       class="form-control"
                       placeholder="Комментарий"
                       v-model="item.comment">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger"
                            v-on:click="deletePhone(index)"
                            type="button">
                        Удалить
                    </button>
                </div>
            </div>
        </div>

        <div class="emails">
            <h4>E-mails</h4>

            <div class="input-group mb-3">
                <input type="email"
                       class="form-control"
                       v-model="email"
                       placeholder="E-mail">
                <div class="input-group-append">
                    <button class="btn btn-outline-success"
                            v-on:click="addEmail"
                            :disabled="email === ''"
                            type="button">
                        Добавить
                    </button>
                </div>
            </div>

            <div class="input-group mb-3" v-for="(item, index) in emails">
                <div class="input-group-prepend">
                    <label class="input-group-text" :for="'email-' + index">
                        {{ item.value }}
                    </label>
                </div>
                <input type="text"
                       :id="'email-' + index"
                       class="form-control"
                       placeholder="Комментарий"
                       v-model="item.comment">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger"
                            v-on:click="deleteEmail(index)"
                            type="button">
                        Удалить
                    </button>
                </div>
            </div>
        </div>

        <div class="webs">
            <h4>Сайты</h4>

            <div class="input-group mb-3">
                <input type="text"
                       class="form-control"
                       v-model="web"
                       placeholder="Сайт">
                <div class="input-group-append">
                    <button class="btn btn-outline-success"
                            v-on:click="addWeb"
                            :disabled="web === ''"
                            type="button">
                        Добавить
                    </button>
                </div>
            </div>

            <div class="input-group mb-3" v-for="(item, index) in webs">
                <div class="input-group-prepend">
                    <label class="input-group-text" :for="'web-' + index">
                        {{ item.value }}
                    </label>
                </div>
                <input type="text"
                       :id="'web-' + index"
                       class="form-control"
                       placeholder="Комментарий"
                       v-model="item.comment">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger"
                            v-on:click="deleteWeb(index)"
                            type="button">
                        Удалить
                    </button>
                </div>
            </div>
        </div>

        <div class="socials">
            <h4>Соц. сети</h4>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="button"
                            v-on:click="socialIco = 'fas fa-share-alt'"
                            class="btn btn-outline-secondary">
                        <i :class="socialIco"></i>
                    </button>
                    <button type="button"
                            class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-vk'">
                            <i class="fab fa-vk fa-3x"></i>
                        </button>
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-odnoklassniki'">
                            <i class="fab fa-odnoklassniki fa-3x"></i>
                        </button>
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-twitter'">
                            <i class="fab fa-twitter fa-3x"></i>
                        </button>
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-facebook'">
                            <i class="fab fa-facebook fa-3x"></i>
                        </button>
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-instagram'">
                            <i class="fab fa-instagram fa-3x"></i>
                        </button>
                        <button class="dropdown-item" v-on:click="socialIco = 'fab fa-telegram-plane'">
                            <i class="fab fa-telegram-plane fa-3x"></i>
                        </button>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       v-model="social"
                       placeholder="Ссылка">
                <div class="input-group-append">
                    <button class="btn btn-outline-success"
                            v-on:click="addSocial"
                            :disabled="social === ''"
                            type="button">
                        Добавить
                    </button>
                </div>
            </div>

            <div class="input-group mb-3" v-for="(item, index) in socials">
                <div class="input-group-prepend">
                    <label class="input-group-text" :for="'social-' + index">
                        <i :class="item.ico" class="pr-1"></i> {{ item.value }}
                    </label>
                </div>
                <input type="text"
                       :id="'social-' + index"
                       class="form-control"
                       placeholder="Комментарий"
                       v-model="item.comment">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger"
                            v-on:click="deleteSocial(index)"
                            type="button">
                        Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['linksData', 'saveLinksUrl'],
        data() {
            return {
                emails: [],
                phones: [],
                socials: [],
                webs: [],
                socialIco: "fas fa-share-alt",
                email: '',
                phone: '',
                social: '',
                web: '',
                loading: false
            }
        },
        methods: {
            saveContact() {
                this.loading = true;
                axios
                    .post(this.saveLinksUrl, {
                        info: {
                            emails: this.emails,
                            phones: this.phones,
                            socials: this.socials,
                            webs: this.webs
                        }
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

            changeOrder(target, index, direction) {
                let tIndex = index;
                if (direction) {
                    tIndex--;
                }
                else {
                    tIndex++;
                }
                let buf = target[index];
                target[index] = target[tIndex];
                Vue.set(target, tIndex, buf);
            },

            addPhone() {
                this.phones.push({
                    value: this.phone,
                    comment: ""
                });
                this.phone = "";
            },
            deletePhone(index) {
                this.phones.splice(index, 1);
            },

            addEmail() {
                this.emails.push({
                    value: this.email,
                    comment: ""
                });
                this.email = "";
            },
            deleteEmail(index) {
                this.emails.splice(index, 1);
            },

            addWeb() {
                this.webs.push({
                    value: this.web,
                    comment: ""
                });
                this.web = "";
            },
            deleteWeb(index) {
                this.webs.splice(index, 1);
            },

            addSocial() {
                this.socials.push({
                    value: this.social,
                    ico: this.socialIco,
                    comment: ""
                });
                this.social = "";
            },
            deleteSocial(index) {
                this.socials.splice(index, 1);
            },
        },
        created() {
            this.emails = this.linksData.emails;
            this.phones = this.linksData.phones;
            this.socials = this.linksData.socials;
            this.webs = this.linksData.webs;
        }
    }
</script>

<style scoped>

</style>

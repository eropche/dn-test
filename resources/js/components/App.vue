<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">DN</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Основная страница</router-link>
                    <router-link to="/statistic" class="nav-item nav-link">Отчеты и таблицы</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>

        <button class="btn btn-secondary" @click="create()">Сформировать рандомный отчет</button>

        <button class="btn btn-secondary" @click="payment()">Оплатить рандомные отчеты</button>
    </div>
</template>

<script>
    export default {
        methods: {
            create() {
                this.axios
                    .get('http://localhost:8080/api/invoice/create')
                    .then(response => {console.log(response.data.result)});
            },
            payment() {
                this.axios
                    .get('http://localhost:8080/api/invoice/payment')
                    .then(response => {console.log(response.data.result)});
            }
        }
    }
</script>

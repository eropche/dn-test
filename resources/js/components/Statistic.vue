<template>
    <div>
        <div>
            <h3 class="text-center">Счета</h3><br/>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Номер счета</th>
                    <th>Клиент</th>
                    <th>Сумма счета</th>
                    <th>Статус оплаты</th>
                    <th>Менеджер</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="invoice in invoices" :key="invoice.number">
                    <td>{{ invoice.number }}</td>
                    <td>{{ invoice.client }}</td>
                    <td>{{ invoice.price }}</td>
                    <td>{{ invoice.paid }}</td>
                    <td>{{ invoice.manager }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h3 class="text-center">Рейтинг (конверсия) менеджеров</h3><br/>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Менеджер</th>
                    <th>Всего счетов</th>
                    <th>Счетов оплачено</th>
                    <th>Конверсия</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="manager in managersStatistic" :key="manager.fullName">
                    <td>{{ manager.fullName }}</td>
                    <td>{{ manager.invocesCount }}</td>
                    <td>{{ manager.paymantCount }}</td>
                    <td>{{ manager.conversion }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h3 class="text-center">Отчет о прибыли за период времени</h3><br/>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Всего счетов</th>
                    <th>Оплаченных счетов</th>
                    <th>Конверсия</th>
                    <th>Прибыль</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="income in incomeStatistic" :key="income.paymentDate">
                    <td>{{ income.paymantDate }}</td>
                    <td>{{ income.invoicesCount }}</td>
                    <td>{{ income.paymantCount }}</td>
                    <td>{{ income.conversion }}</td>
                    <td>{{ income.income }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                invoices: [],
                managers: [],
                clients: [],
                incomeStatistic: [],
                managersStatistic: [],
            }
        },
        created() {
            this.axios
                .get('http://localhost:8080/api/invoice/list?managerId=&clientId=&paid=')
                .then(response => {
                    this.invoices = response.data.list;
                });
            this.axios
                .get('http://localhost:8080/api/invoice/income-statistic?startPaymantDate=&endPaymantDate=')
                .then(response => {
                    this.incomeStatistic = response.data.statistic;
                });
            this.axios
                .get('http://localhost:8080/api/manager/statistic')
                .then(response => {
                    this.managersStatistic = response.data.managers;
                });
            this.axios
                .get('http://localhost:8080/api/manager/list')
                .then(response => {
                    this.managers = response.data.managers;
                });
            this.axios
                .get('http://localhost:8080/api/client/list')
                .then(response => {
                    this.clients = response.data.clients;
                });
        },
        methods: {

        }
    }
</script>

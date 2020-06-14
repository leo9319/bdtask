<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">
        <title>Bdtask | Home</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
    </head>
    <body class="text-center" data-gr-c-s-loaded="true">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column" id="app">
            <header class="masthead">
                <div class="inner">
                    <h3 class="masthead-brand">BdTask</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Salary Configuration</a>
                    </nav>
                </div>
            </header>

            <main role="main" class="inner cover">
                <h1 class="cover-heading">Monthly Average Salary: @{{ monthlySalary | formatNumber }}</h1>
                <h1 class="cover-heading">Expected Earning in a year: @{{ yearlySalary | formatNumber }}</h1>
            </main>

            <div class="input-group my-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Basic Salary</span>
                </div>
                <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" v-model="basic">
            </div>

            <div class="my-2 d-flex flex-row">
                <div>
                    Has the employee worked more than 8 hours excuding fridays and govt. holidays?
                </div>
                <div class="m-2">
                    <input type="checkbox" id="toggle-two" onchange="app.checked = $(this).prop('checked')">
                </div>
            </div>

            <div class="d-flex justify-content-center my-2">
                <p>Yearly reveneue</p>
                <form class="range-field w-75">
                    <input id="slider11" class="border-0 w-75" type="range" min="1000000" max="100000000" v-model="yearlyRevenue" />
                </form>
                <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan">@{{ yearlyRevenue | formatNumber }}</span>
            </div>

            <div class="justify-content-center my-2">
                <p>Provident Fund: @{{ settings.provident_fund_percentage }}%</p>
            </div>

            <div class="justify-content-center my-2">
                <p>Insurance Premium: @{{ settings.insurance_premium | formatNumber }} per year (@{{ perMonthInsurance.toFixed(2) }} per month)</p>
            </div>

            <div class="justify-content-center my-2">
                <p>Technical Team members: @{{ settings.technical_team }}</p>
            </div>

            <div class="justify-content-center my-2">
                <p>Revenue Share: @{{ settings.revenue_share_percentage }}% (@{{ perMonthIndividualRevenueShare.toFixed(2) | formatNumber }} per month individually)</p>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
        <script>
            $(function() {
                $('#toggle-two').bootstrapToggle({
                    on: 'Yes',
                    off: 'No',
                    onstyle: 'success',
                    offstyle: 'danger'
                });
            })
        </script>
        <script type="text/javascript">
            var app = new Vue({
                el: '#app',
                data: {
                    settings: {
                        provident_fund_percentage: 0,
                        revenue_share_percentage: 0,
                        technical_team: 0,
                        insurance_premium: 0
                    },
                    checked: false,
                    basic: 30000,
                    yearlyRevenue: 20000000
                },
                computed: {
                    monthlySalary(){
                        let basicAfterInsurance = this.checked ? (this.basic - this.perMonthInsurance) : 0
                        let providentFund = (basicAfterInsurance * this.settings.provident_fund_percentage)/100
                        let afterProvident = basicAfterInsurance - providentFund
                        let afterReveueShare = this.perMonthIndividualRevenueShare + afterProvident

                        return afterReveueShare.toFixed(2)

                    },
                    perMonthInsurance(){
                        return (this.settings.insurance_premium / 12);
                    },
                    perMonthIndividualRevenueShare(){
                        return ((this.yearlyRevenue * this.settings.revenue_share_percentage) /(100 * 12 * this.settings.technical_team));
                    },
                    yearlySalary(){
                        return (this.monthlySalary * 12).toFixed(2)
                    }
                },
                created() {
                    axios.get('settings/get-data')
                        .then(response => this.settings = response.data)
                        .catch(error => alert('data wiped from database!'))
                },
                filters: {
                    formatNumber(value){
                        value = parseFloat(value)
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            });
        </script>

    </body>
</html>
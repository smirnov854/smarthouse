<!-- Date-picker itself -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>

<!--<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.22"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/pc-bootstrap4-datetimepicker@4.17/build/js/bootstrap-datetimepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/pc-bootstrap4-datetimepicker@4.17/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/vue-bootstrap-datetimepicker@5"></script>
<link rel='stylesheet' href="/resources/css/component-custom-switch.css">
<script>
    // Initialize as global component
    Vue.component('date-picker', VueBootstrapDatetimePicker);
    $.extend(true, $.fn.datetimepicker.defaults, {
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'far fa-times-circle'
        }
    });
</script>
<div id="meter_row_controller" class="justify-content-center mx-4 my-4">
    <div>
        <div class="col-lg-9 float-left">
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Номер стояка</label>
                <input class="form-control col-lg-8 float-left" type="text" v-model="tube">
            </div>

        </div>

        <div class="col-lg-9 float-left">
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Состояние</label>
                <select class="form-control" v-model="status">
                    <option value="0"></option>
                    <option value="1">Открыт</option>
                    <option value="2">Закрыт</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 float-left">
            Инструкция
        </div>

        <div class="form-group col-lg-3 float-left">
            <button class="btn btn-success search_button" v-on:click="search(0)">Найти</button>
            <!--
            <button class="btn btn-primary add_flat_meter" data-toggle="modal" data-target="#add_flat_meter" ref="add_button" v-on:click="reset_all()">Добавить</button>
            -->
        </div>

        <div class="clearfix"></div>
        <div>Всего записей : {{total_rows}}</div>
    </div>
    <div>
        <paginator v-bind:total_pages="pages" v-bind:current_page="current_page"></paginator>

        <table class="table table-bordered" v-if="wc_list.length>0">
            <thead>
            <tr>
                <th>id</th>
                <th>Номер стояк</th>

                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(wc_row,index) in wc_list">
                <td>{{wc_row.wc_id}}</td>
                <td>{{wc_row.fl_tube}}</td>
                <td>

                    <div class="custom-switch pl-0">
                        <input class="custom-switch-input"
                               v-bind:id="wc_row.wc_id"
                               type="checkbox"
                               v-on:change="change_status(index,wc_row.fl_tube,wc_row.wc_status)"
                               v-bind:checked="wc_row.wc_status == 1">
                        <label class="custom-switch-btn" v-bind:for="wc_row.wc_id"></label>
                        <span v-if="wc_row.wc_status == 1">Закрыт</span>
                        <span v-if="wc_row.wc_status == 0">Открыт</span>
                    </div>



                </td>
            </tr>
            </tbody>
        </table>

        <paginator v-bind:total_pages="pages" v-bind:current_page="current_page"></paginator>
    </div>
</div>

<script src="/resources/js/components.js"></script>
<script type="text/javascript">
    el = new Vue({
        el: "#meter_row_controller",
        data: {
            options: {
                // https://momentjs.com/docs/#/displaying/
                format: 'DD.MM.YYYY',
                useCurrent: false,
                showClear: true,
                showClose: true,
            },
            current_page: 0,
            total_pages: 0,
            total_rows: 0,
            date_from:'',
            flat_id: 0,
            tube:'',
            per_page: 25,
            pages: [],
            flat_meter_value:'',
            flat_name: '',
            port_number:'',
            date_to: '',
            error: "",
            new_row : {edit_id:0},
            meter_type_id:[],
            wc_list: [],
            from_edit: 0,
            status:0,
        },
        methods: {
            change_status: function (index,tube,current_state) {
                axios.post("/water_controller/change_status/",
                    {
                        tube:tube,
                        cur_status:current_state
                    } ).then(function (result) {
                        setTimeout(function(){

                            el._data.wc_list[index].cur_status = result.data.content
                            el._data.wc_list[index].wc_status = result.data.content
                            el.search()
                        },100)
                }).catch(function (e) {
                    console.log(e)
                })
            },
            search: function (page = 0) {
                this.current_page = page
                axios.post("/water_controller/search/" + page, {
                    status:el._data.status,
                    tube: el._data.tube,
                }).then(function (result) {
                    switch (result.data.status) {
                        case 200:
                            el._data.pages.splice(0);
                            el._data.wc_list.splice(0)
                            el._data.wc_list = result.data.content;
                            el._data.total_rows = result.data.total_rows;
                            el._data.total_pages = Math.ceil(el._data.total_rows / el._data.per_page);

                            if(el._data.total_rows > 25){
                                el._data.pages.splice(0);
                                el._data.pages.push(1)
                                let tmp_page = page === 0 ? page + 1 : page;
                                let z = 0;
                                while (tmp_page > 2) {
                                    z++;
                                    el._data.pages.push(tmp_page--)
                                    if (z === 5) {
                                        break;
                                    }
                                }
                                z = 0;
                                tmp_page = page === 0 ? page + 2 : page + 1
                                while (tmp_page < el._data.total_pages) {
                                    z++;
                                    el._data.pages.push(tmp_page++)
                                    if (z === 5) {
                                        break;
                                    }
                                }
                                if(el._data.total_pages !== page){
                                    el._data.pages.push(el._data.total_pages)
                                }
                                el._data.pages.sort(function (a, b) {
                                    return a - b;
                                });
                            }
                            break;
                        case 300:
                            break;
                        default:
                            alert(result.data.message)
                            break;
                    }
                }).catch(function (e) {
                    console.log(e)
                })
            },
        },
        mounted(){
            setTimeout(function(){
                //el.get_type_list();
                el.search()
            },100)
        }
    })
</script>
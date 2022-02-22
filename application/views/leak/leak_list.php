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
                <label class="col-lg-4 c float-left">Номер квартиры</label>
                <input class="form-control col-lg-8 float-left" type="text" v-model="flat_name">
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">ID квартиры</label>
                <input class="form-control col-lg-8 float-left" type="number" v-model="flat_id">
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Номер стояка</label>
                <input class="form-control col-lg-8 float-left" type="text" v-model="tube">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Тип</label>
                <select v-model="value" class="form-control">
                    <option value="-1">Без значения</option>
                    <option value="0">Сухо</option>
                    <option value="1">Протечка</option>
                </select>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Порядок</label>
                <select class="form-control" v-model="order_by_direction">
                    <option value="asc">Прямой</option>
                    <option value="desc">Обратный</option>
                </select>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Соритровка</label>
                <select class="form-control" v-model="order_by">
                    <option value="stamp">Дата</option>
                    <option value="fl.name">Номер квартиры</option>
                    <option value="tube">Стояк</option>
                    <option value="value">Значение</option>
                    <option value="port">Порт</option>
                </select>
            </div>
            <!--
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Дата от</label>
                <date-picker class="float-left datepicker col-lg-9" v-model='date_from' :config='options'></date-picker>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-12 float-left">
                <label class="col-lg-4 c float-left">Дата по</label>
                <date-picker class="float-left datepicker col-lg-9" v-model='date_to' :config='options'></date-picker>
            </div>
            -->
            <div class="clearfix"></div>

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
    <?php $this->load->view("/flat_meter/flat_meter_add");?>
    <div>
        <paginator v-bind:total_pages="pages" v-bind:current_page="current_page"></paginator>

        <table class="table table-bordered text-center" v-if="alert_list.length>0">
            <thead>
            <tr>
                <th>id</th>
                <th>Дата</th>
                <th>Квартира</th>
                <th>Стояк</th>
                <th>Тип</th>
                <th>Порт</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(alert,index) in alert_list">
                <td>{{alert.id}}</td>
                <td>{{alert.fs_stamp}}</td>
                <td>{{alert.flat_name}}</td>
                <td>{{alert.fs_tube}}</td>
                <th>{{alert.fs_type == 1 ? 'Протечка' : (alert.fs_type == 0 ? 'Сухо' : 'Без значения')}}</th>
                <td>{{alert.port}}</td>
                <td>{{alert.person_phone}}</td>
                <!--<td>
                    <span class="fa fa-pencil edit-row" v-on:click="edit_row(index)"></span>
                    <span class="fa fa-remove delete-row float-right" v-on:click="delete_row(index,meter_row.id)"></span>
                </td>-->
            </tr>
            </tbody>
        </table>

        <paginator v-bind:total_pages="pages" v-bind:current_page="current_page"></paginator>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<div class="modal" tabindex="-1" role="dialog" id="alert_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Предупреждение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                <span id="modal_content"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
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
            date_to:'',
            value:'',
            flat_id: 0,
            tube:'',
            order_by_direction:'',
            order_by:'',
            per_page: 25,
            pages: [],
            flat_name: '',
            error: "",
            new_row : {edit_id:0},
            meter_type_id:[],
            meter_type_list:{},
            alert_list: [],
            from_edit: 0,
        },
        methods: {/*
            delete_row: function (index, id) {
                if(window.confirm("Вы подтверждаете удаление?")){
                    axios.post("/flat_meter/delete/" + id, {
                        id: id,
                    }).then(function (result) {
                        switch (result.data.status) {
                            case 200:
                                el._data.meter_list.splice(index, 1)
                                break;
                            case 300:
                                alert(result.message)
                                break;
                            default:
                                alert(result.data.message)
                                break;
                        }
                    }).catch(function (e) {
                        console.log(e)
                    })
                }
            },
            get_type_list:function(){
                axios.post("/flat_meter/get_type_list/", {}).then(function (result) {
                    //el._data.meter_type_list.push({id:0,name:'Не выбрано'})
                    el._data.meter_type_list = result.data.contents;
                }).catch(function (e) {
                    console.log(e)
                })
            },
            check_form: function (new_row) {
                var errors = [];
                if (!new_row.name) {
                    errors.push("Укажите наименование!");
                }
                if (!new_row.flat_id) {
                    errors.push("Укажите ID квартиры!");
                }
                if (!new_row.acc_id) {
                    errors.push("Укажите ID счетчика!");
                }
                if (!new_row.meter_type_id) {
                    errors.push("Укажите тип счетчика!");
                }
                if (!new_row.value) {
                    errors.push("Укажите значение!");
                }
                if (!new_row.tube) {
                    errors.push("Укажите номер стояка!");
                }
                return errors;
            },
            add_new_row: function (new_row) {
                var errors = this.check_form(new_row)
                if (errors.length > 0) {
                    this.error = errors.join(" ")
                    return;
                }
                var url = "/flat_meter/add_new_meter";
                if (this.new_row.edit_id != 0) {
                    url = "/flat_meter/edit_meter/" + this.new_row.edit_id;
                }

                axios.post(url, new_row).then(function (result) {
                    switch (result.data.status) {
                        case 200:
                            alert(result.data.message);
                            document.querySelector(".close_dialog").click();                            
                            this.new_row.name = ""
                            this.new_row.flat_id = ""
                            this.new_row.acc_id = ""
                            this.new_row.port = ""
                            this.new_row.value = ""
                            this.new_row.meter_type_id = ""
                            this.new_row.tube = ""
                            el.search(1);
                            break;
                        case 300:
                            alert(result.data.message)
                            break;
                        default:
                            alert(result.data.message)
                            break;
                    }
                }).catch(function (e) {
                    console.log(e)
                })
            },
            edit_row: function (index) {
                this.new_row = el.$data.meter_list[index]
                this.new_row.edit_id = this.new_row.id
                this.from_edit = 1
                this.$refs.add_button.click()
            },*/
            search: function (page = 0) {
                this.current_page = page
                axios.post("/leak/search/" + page, {
                    meter_type_id: el._data.meter_type_id,
                    flat_id : el._data.flat_id,
                    tube: el._data.tube,
                    flat_name: el._data.flat_name,
                    date_to : el._data.date_to,
                    date_from : el._data.date_from,
                    value:el._data.value,
                    order_by:el._data.order_by,
                    order_by_direction:el._data.order_by_direction,
                }).then(function (result) {
                    switch (result.data.status) {
                        case 200:
                            el._data.pages.splice(0);                            
                            el._data.alert_list.splice()
                            el._data.alert_list = result.data.content;
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
            /*
            deselect_type_id: function(){              
                el._data.meter_type_id.splice(0)                
            },*//*
            reset_all:function(){
                console.log(this.from_edit);
                if(this.from_edit == 0 && this.new_row.edit_id !=0){
                    this.new_row.edit_id = 0
                    this.new_row.name = ""
                    this.new_row.flat_id = ""
                    this.new_row.acc_id = ""
                    this.new_row.port = ""
                    this.new_row.value = ""
                    this.new_row.meter_type_id = ""                   
                    this.new_row.tube = ""
                }
                this.from_edit = 0
            }*/
        },
        mounted(){
            setTimeout(function(){
                //el.get_type_list();
                el.search()
            },100)            
        } 
    })
</script>

<script>
    let pusher = new Pusher("e57dcea383612fea69ee", { cluster: "eu",});
    pusher.subscribe("leak_notification").bind('receive_message',function(data){
        let textMessage = data.message
        let ids = data.ids
        get_warnings()
        showMessage(textMessage,ids);
    })

    function showMessage(textMessage, ids){
        $("#modal_content").text(textMessage);
        $('#alert_modal').modal('show');
        /*
        $.post("/leak/set_message_status",{ids:ids},function(){

        },"json")
        */
    }
</script>
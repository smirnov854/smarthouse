<div id="vue-container" class="container-fluid">
    <div class="col-lg-6 col-md-6 col-sm-12 my-3 float-left">
        <div class="text-center">Экспорт</div>
        <div class="form-group col-lg-5 col-md-6 col-sm-12 float-left">
            <label class="col-lg-4 c float-left">C</label>
            <input class="form-control col-lg-8 float-left" type="date" v-model="dateStart">
        </div>
        <div class="form-group col-lg-5 col-md-6 col-sm-12 float-left">
            <label class="col-lg-4 c float-left">По</label>
            <input class="form-control col-lg-8 float-left" type="date" v-model="dateEnd">
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-6 col-md-6 col-sm-12 float-left">
            <label class="col-lg-4 c float-left">Квартира</label>
            <input class="form-control col-lg-8 float-left" type="text" v-model="flats">
        </div>
        <div class="col-lg-6 float-left">
            <button class="btn btn-success float-left" v-on:click="do_export">Сохранить</button>
            <a id='link_to_download' href="" target="_blank" style="display: none">Скачать</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 my-3 float-left">
        <div class="text-center">Импорт</div>
        <div class="form-group col-lg-6 col-md-6 col-sm-12 float-left">
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
        </div>

        <div class="col-lg-4 float-left">
            <button class="btn btn-success float-left" v-on:click="submitFile()">загрузить</button>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script type="text/javascript">
    el = new Vue({
        el: "#vue-container",
        data: {
            dateStart:'',
            dateEnd:'',
            flats:''
        },
        methods: {
            do_export: function () {
                axios.post("/data/do_export" , {
                    dateStart: this._data.dateStart,
                    dateEnd: this._data.dateEnd,
                    flats: this._data.flats
                }).then(function (result) {
                    console.log(result.data.file_name)
                    document.getElementById('link_to_download').setAttribute('href',
                        result.data.file_name
                    )
                    document.getElementById('link_to_download').click()
                }).catch(function (e) {
                    console.log(e)
                })
            },
            submitFile(){
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( '/data/do_import',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(result){
                    alert(result.data.message)
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        },
        mounted() {

        }

    })
</script>
</div>
<script>
    $(function(){
        get_warnings()
    })
    function get_warnings(){
        $.post("/warnings/get_new_warnings",function(result){
            $("#warning_container").text(result.content)
        },"json")
    }
</script>
</body>
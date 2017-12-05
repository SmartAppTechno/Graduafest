<style>
.custom-input-file {
    overflow: hidden;
    position: relative;
    cursor: pointer;
    border: 1px solid #428bca;
    border-radius: 5px;
    background-color: #428bca;
    color: #fff;
    text-align: center;
    font-family: verdana;
    font-size: 12pt;
    width: 100%;
    min-height: 40px;
}
.custom-input-file:hover {
    background-color: #336B9C;
    color: #fff;
}
.custom-input-file .input-file {
    margin: 0;
    padding: 0;outline:0;
    font-size: 10000px;
    border: 10000px solid transparent;
    opacity: 0;
    filter: alpha(opacity=0);
    position: absolute;
    right: -1000px;
    top: -1000px;
    cursor: pointer;
}
.custom-input-file .archivo {
    background-color: #fff;
    color: #000;
    font-size: 7pt;
    overflow: hidden;
}
.custom-input-file:hover .archivo {
    background-color: #fff;
    color: #000;   
}
</style>
<script>
    $(function(){
        $(".custom-input-file input:file").change(function(){
            $(this).parent().find(".archivo").html($(this).val());
        }).css('border-width',function(){
            if(navigator.appName == "Microsoft Internet Explorer")
                return 0;
        });
    });
</script>
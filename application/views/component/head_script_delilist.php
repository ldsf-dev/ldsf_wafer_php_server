<script type="text/javascript">
    <!--
    // 検索条件表示切替
    function searchChange() {

        var elements_th = document.getElementsByName("expressnoth");
        var elements_td = document.getElementsByName("expressnotd");
        if (document.getElementById("searchChangeFlg").value == "1") {
            for (var i = 0; i < elements_th.length; i++) {
                elements_th[i].style.display = "block";
            }
            for (var i = 0; i < elements_td.length; i++) {
                elements_td[i].style.display = "block";
            }
            document.getElementById("searchChange").innerHTML = "隐藏物流单号";
            document.getElementById("searchChangeFlg").value = "0";
        } else {
            for (var i = 0; i < elements_th.length; i++) {
                elements_th[i].style.display = "none";
            }
            for (var i = 0; i < elements_td.length; i++) {
                elements_td[i].style.display = "none";
            }
            document.getElementById("searchChange").innerHTML = "显示物流单号";
            document.getElementById("searchChangeFlg").value = "1";
        }

        return false;
    }

    function redirectToNew(){
        window.location.href="/admin/index"
    }

    // -->
</script>
<script type="text/javascript">
    <!--
    // 検索条件表示切替
    function searchChange() {

        var elements = document.getElementsByName("qrcode");
        if (document.getElementById("searchChangeFlg").value == "1") {
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            document.getElementById("searchChange").innerHTML = "－";
            document.getElementById("searchChangeFlg").value = "0";
        } else {
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = "none";
            }
            document.getElementById("searchChange").innerHTML = "＋";
            document.getElementById("searchChangeFlg").value = "1";
        }

        return false;
    }

    // -->
</script>
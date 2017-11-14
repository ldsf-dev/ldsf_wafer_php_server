<script type="text/javascript">
    function confirmdate() {
        date = document.getElementById("date").value;
        document.getElementById("form1").action="/admin/selectdeliverysbydelidate/1/200/" + date;
        return true;
    }
</script>
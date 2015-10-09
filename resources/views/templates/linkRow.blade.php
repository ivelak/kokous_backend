<script>
    $(document).ready(function () {
        $("tr").on({
            mouseenter: function () {
                $(this).css('cursor', 'pointer');
            },
            mouseleave: function () {
                $(this).css('cursor', 'auto');
            },
            click: function () {
                document.location.href = "/{{Request::path()}}/" + $(this).attr("id");
            }
        });
    });
</script>
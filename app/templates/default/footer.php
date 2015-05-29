</div>
</div>
</body>
<script>
    $(document).ready(function() {
        $("select").select2().ready($("#s2id_autogen1").children(":first").prepend("<span id='placeholder-id'>Seleccione un caso...</span> "));
    });
</script>
</html>
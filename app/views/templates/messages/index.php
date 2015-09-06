{% if flash.global %}
<script>
Materialize.toast("{{flash.global}}", 2000);
</script>
{% endif %}
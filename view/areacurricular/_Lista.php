<script type="text/javascript">
    $(function(){
        $( "#q" ).focus();
    });    
    function get(p1,p2,p3,p4)
    {
        opener.document.getElementById('CodigoAreaCurricular').value=p1;
        opener.document.getElementById('DescripcionArea').value=p2;
        opener.document.getElementById('TotalCursos').value=p3;
        opener.document.getElementById('TotalCreditos').value=p4;
        window.close();
    }
</script>
<div class="div_container">
<h6 class="ui-widget-header">Areas Curriculares Registradas</h6>
<?php echo $grilla; ?>
</div>
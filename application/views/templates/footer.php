</div>
<script>
    for (var i = 0; i < document.links.length; i++) {
        if (document.links[i].href == document.URL) {
            document.links[i].className = 'active';
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/birthdate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/navbar.js"></script>
</body>
</html>



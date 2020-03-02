<footer>
    <form action="<?php echo base_url(); ?>PageController/view/overview">
        <button type='button' class='back' onclick="history.back()" >
            <strong>Ga terug</strong>
        </button>
    </form>
</footer>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<stript src="js/jquery.dataTables.min.js"></stript>
<?php if (isset($jslibs_to_load)) foreach ($jslibs_to_load as $jslib): ?>
    <script src="<?=base_url()?>assets/js/<?= $jslib?>"></script>
<?php endforeach; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/birthdate.js"></script>
</body>
</html>

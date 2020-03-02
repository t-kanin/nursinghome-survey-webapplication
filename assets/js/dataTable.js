$('#Table').DataTable({
    "info": false

});
$('#Table_wrapper .dataTables_filter').find('input').each(function () {
    const $this = $(this);
    $this.attr("placeholder", "Search");
})
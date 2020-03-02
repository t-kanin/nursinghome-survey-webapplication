var table = $('#Table').DataTable({
    "columnDefs": [
        { "orderable": false, "targets": 2 }
    ],
    "info":false
});
var index = 2;
table.columns(2).eq(0).each( function ( index) {
    var column = table.column( index );
    var select = $('<select><option value="">Categorie</option></select>')
        .appendTo( $(column.header()).empty() )
        .on( 'change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            column
                .search( val ? '^'+val+'$' : '', true, false )
                .draw();
        } );

    column.data().unique().sort().each( function ( d, j ) {
        select.append( '<option value="'+d+'">'+d+'</option>' )
    } );
} );
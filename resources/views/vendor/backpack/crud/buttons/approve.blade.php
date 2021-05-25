@if ($crud->hasAccess('update') && $entry->status === \App\Models\Reservation::ESTADO_RESERVACION_PENDIENTE)
    <a href="javascript:void(0)" onclick="approveTransaction(this)" data-route="{{ url($crud->route).'/'.$entry->getKey().'/approve' }}" class="btn btn-sm btn-link" data-button-type="approve">
        <span class="ladda-label"><i class="fas fa-check"></i> APROBAR </span>
    </a>
@endif
<script>
    if (typeof approveTransaction != 'function') {
        $("[data-button-type=approve]").unbind('click');

        function approveTransaction(button) {
            // ask for confirmation before deleting an item
            // e.preventDefault();
            var button = $(button);
            var route = button.attr('data-route');
            console.log(route);
            $.ajax({
                url: route,
                type: 'PATCH',
                success: function(result) {
                    // Show an alert with the result
                    console.log(result,route);
                    new Noty({
                        text: "Some Tx had been approved",
                        type: "success"
                    }).show();

                    // Hide the modal, if any
                    $('.modal').modal('hide');

                    crud.table.ajax.reload();
                },
                error: function(result) {
                    // Show an alert with the result
                    console.log(result,route);
                    new Noty({
                        text: "The new entry could not be created. Please try again.",
                        type: "warning"
                    }).show();
                }
            });
        }
    }
</script>

<x-layouts.app>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/components/table_dropdown.css') }}">
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    @endpush()
    <!-- edit modal -->
    <!-- <div class="app-flash" role="status">{{ session('success') }}</div> -->
    <x-bootstrap.modal id="edit_modal" modeltitle="Edit Allowance" submitbutton="Save Changes"
        submitbuttonid="submitbutton">
        <form id="edit_modal_form" action="{{ route('allowance.edit') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="type" id="edit_type">
                    </td>
                </tr>
                <tr>
                    <td>Value</td>
                    <td>
                        <input type="text" name="new_value" id="edit_value">
                    </td>
                </tr>
            </table>
            <input type="hidden" name="edit_id" id="edit_id">
        </form>
    </x-bootstrap.modal>


    <section class="table-panel" style="padding:0; margin:0;">
        <div class="table-responsive" style="width:100%; margin:0; padding:0;">
            <x-data_table :headers="[
        'id',
        'type',
        'value',
        'Actions',
    ]" id="allowance_table"
                pagetitle="Allowance List" ajax="allowance.getData" />
        </div>
    </section>

    @push('external_scripts')
        <script>
            function deleteAllowance(id) {
                let url = '{{ route("allowance.delete", ":id") }}'
                url = url.replace(":id", id);
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(response => response.json()).then(result => {
                    if (result.success) {
                        Swal.fire("success", "Allowance Deleted");
                    }
                    $('#allowance_table').DataTable().ajax.reload();
                });
            }

            function editAllowance(id, name, value) {
                $('#edit_type').val(name);
                $('#edit_value').val(value);
                $('#edit_id').val(id);
                $('#edit_modal').modal('show');
            }

            document.getElementById('submitbutton').addEventListener('click', function (e) {
                document.getElementById('edit_modal_form').submit();
            });
        </script>
    @endpush
</x-layouts.app>
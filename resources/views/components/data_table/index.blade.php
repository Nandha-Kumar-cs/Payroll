@props(['headers' => null, 'id' => null, 'pagetitle' => null, 'ajax'])
<table class="table table-striped table-bordered table-hover m-0 datatable-v1" id="{{ $id }}">
    <thead>
        @foreach ($headers as $head)
            <th>{{ $head }}</th>
        @endforeach
    </thead>
    <tbody></tbody>
    <tfoot>
        @foreach ($headers as $head)
            <th>{{ $head }}</th>
        @endforeach
    </tfoot>
</table>
@push('external_scripts')
    <script>
        (() => {
            const tableHeader = '{{ $pagetitle }}';
            const tableId = '{{ $id }}';

            function adjustTableHeight() {
                const windowHeight = $(window).height();
                const headerHeight = $(".app-nav").outerHeight(true) + 40;
                const footerHeight = $(".footer").outerHeight(true) || 35;
                const tableFooterHeight = $(".dataTables_scrollFoot").outerHeight(true) || 50;
                const availableHeight = windowHeight - (headerHeight + footerHeight + tableFooterHeight + 40);
                const rowHeight = 40;
                const pageLength = Math.max(Math.floor(availableHeight / rowHeight), 5);

                localStorage.setItem(tableHeader + "_length", pageLength);

                return [pageLength, availableHeight];
            }

            const heightResponse = adjustTableHeight();
            const dataTable = $('#' + tableId).DataTable({
                dom: '<"top"iBp<"dt_title">>t<"bottom"><"clear">',
                serverSide: true,
                processing: true,
                scroller: true,
                scrollY: heightResponse[1] + "px",
                pageLength: heightResponse[0],
                ajax: {
                    url: '{{ route($ajax) }}',
                    data: function (d) {
                        d.length = heightResponse[0];
                    },
                    error: function (xhr, error, thrown) {
                        console.log("Failed to load table data  : ", xhr, error, thrown);
                    },
                    complete: function () {
                        $(".spinner-wrapper").css("visibility", "hidden");
                    },
                },
                autoWidth: false,
                initComplete: function () {
                    const tableWrapper = document.querySelector('#' + tableId + '_wrapper');
                    const titleNode = tableWrapper ? tableWrapper.querySelector('.dt_title') : null;
                    if (titleNode) {
                        titleNode.textContent = tableHeader;
                    }

                    const api = this.api();
                    api.columns().every(function (index) {
                        const column = this;
                        const footer = $(column.footer());
                        const title = footer.text();
                        const storageKey = "footerSearch_" + tableId + "_" + index + "_" + title;
                        const input = $(
                            '<input type="text" class="footer-search" placeholder="Search ' + title + '" />'
                        )
                            .appendTo($(column.footer()).empty())
                            .css({
                                width: "90%",
                                padding: "3px",
                                "box-sizing": "border-box",
                                "font-size": "13px",
                            });

                        const state = api.state.loaded();
                        if (state && state.columns[index].search.search) {
                            input.val(state.columns[index].search.search);
                            column.search(state.columns[index].search.search);
                        }

                        input.on("keyup change", function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                                localStorage.setItem(storageKey, this.value);
                            }
                        });
                    });

                    $(document).trigger('table-ready', [dataTable, tableId]);
                }
            });
        })();
    </script>
@endpush()
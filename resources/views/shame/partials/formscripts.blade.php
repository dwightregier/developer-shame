{{-- jQuery UI --}}
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
{{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
<script>
    $(function () {
        var availableTags = {!! $js_tags . ';' !!}

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#tags").bind("keydown", function (event) {
            // Don't navigate away from the field on tab when selecting an item
            if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        }).autocomplete({
            minLength: 0,
            source: function (request, response) {
                // Delegate back to autocomplete, but extract the last term
                response($.ui.autocomplete.filter(availableTags, extractLast(request.term)));
            },
            focus: function () {
                // Prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // Remove the current input
                terms.pop();
                // Add the selected item
                terms.push(ui.item.value);
                // Add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;
            }
        });
    });
</script>
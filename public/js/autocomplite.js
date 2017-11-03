function initAutocomplite() {
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
}
$(document).ready(function() {
    initAutocomplite();
});

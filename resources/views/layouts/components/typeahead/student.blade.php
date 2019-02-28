<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{route('enrollment.file.find')}}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,

        });

        $("input.enrollment-search").typeahead({
            hint: true,
            highlight: true,
            minLength: 1,
        }, 
        {
            source: engine.ttAdapter(),
            limit: 1000,

            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'student-suggestions',

            templates: {
                empty:'<div class="list-group-item text-center text-danger"><i class="fa fa-exclamation-triangle"></i> No student file found</div>',
                pending: '<div class="list-group-item text-center">searching files...</div>',
                suggestion: function (data) {
                    var file = "{{url('/')}}/enrollment/"+data.id;
                    var result = '<div class="list-group-item"><strong><a href="'+file+'">'+data.surname+' '+data.other_names+'</a></strong>';
                            result += '<div>'+(data.student == null ? '<i class="text-warning">Enrollment pending</i>' : '')+'</div>';
                        result += '</div>';
                    return result;
            }
            }
        }).bind('typeahead:select', function(ev, suggestion) {
                $(this).typeahead('val',suggestion.surname+' '+suggestion.other_names)
        });
    }); 

</script>
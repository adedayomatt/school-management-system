<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{route('staff.file.find')}}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,

        });

        $("input.staff-search").typeahead({
            hint: true,
            highlight: true,
            minLength: 1,
        }, 
        {
            source: engine.ttAdapter(),
            limit: 1000,

            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'staff-suggestions',

            templates: {
                empty:'<div class="list-group-item text-center text-danger"><i class="fa fa-exclamation-triangle"></i> No staff file found</div>',
                pending: '<div class="list-group-item text-center">searching files...</div>',
                // header: '<div class="list-group-item text-center font-weight-bold">Tags ResultsFound:</div>',
                // footer: '<div class="list-group-item text-center">Footer Content</div>',
                suggestion: function (data) {
                    var file = "{{url('/')}}/staff/"+data.id;
                    var result = '<div class="list-group-item"><strong><a href="'+file+'">'+data.surname+' '+data.other_names+'</a></strong>';
                            result += '<div><i class="fa fa-user-tie"></i> <span class="mx-2">'+data.role.name+'</span> <span class="mx-2">'+(data.classroom == null ? '<small class="text-warning">no class</small>' : data.classroom.name)+'</span></div>';
                        result += '</div>';
                    return result;
            }
            }
        }).bind('typeahead:select', function(ev, suggestion) {
                $(this).typeahead('val',suggestion.surname+' '+suggestion.other_names)
        });
    }); 

</script>
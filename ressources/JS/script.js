$(function ()
    {
        // Dropdown header
        $('.dropdown-trigger').dropdown();
        // Search bar header
        // A modifier avec les personnes inscrites
        $(document).ready(function(){
            $('input.autocomplete').autocomplete({
              data: {
                "Apple": null,
                "Microsoft": null,
                "Google": 'https://placehold.it/250x250'
              },
            });
          });
    });
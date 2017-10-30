$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $('.input-fields-wrap');
    var add_button      = $('.add-field-button');

    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<tr> <td> <input type="text" class="form-control" name="ingredient[]" value="" > </td> <td> <input type="text" class="form-control" name="quantity[]" value="" > </td> <td><a href="#" class="remove-field">Remove</a></td> </tr>');
        }
    });

    $(wrapper).on("click",".remove-field", function(e){
        e.preventDefault(); $(this).parent('td').parent('tr').remove(); x--;
    })
});

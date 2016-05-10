$(function(){
    $('#modalButton').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    $('#modalButton1').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    $('#modalButton2').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    $('.modalClase').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    
    
});


const URL = 'https://appbonus.justcode.am/';

function myFunction(chosen) {
    if(chosen == 'Y'){
       document.querySelector('.date').style.display = 'block';
    }else{

        document.querySelector('.date').style.display = 'none';
    }
}



$(".chaguchForm").submit(function(e){
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var login = $("input[name=loginOs]").val();
    var password = $("input[name=password]").val();
    var company_id = $("input[name=company_id]").val();
    var TrueOrFalse = $('#comboAAS').val();
    var name = $("input[name=MeanagerName]").val();
    var phone = $("input[name=Meanagerphone]").val();


    $.ajax({
        type:'POST',
        url:URL+'CreateNewMeanger',
        data:{login:login, password:password, company_id:company_id, TrueOrFalse:TrueOrFalse, name:name, phone:phone},
        success:function (response) {
            if(response.status == false){
                $('.existEmail').css("border", "1px solid red");
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Gerente agregado con éxito',
                    showConfirmButton: false,
                    timer: 1000
                })

                setTimeout(function() {
                    window.location.reload(true);
                }, 1000);
            }
        }
    
    });

});

$(".existEmail").on('input', function(e){
    e.preventDefault();
    $('.existEmail').css("border", "1px solid green");

});



// $(".UpdateFormsd").submit(function(e){
//
//     e.preventDefault();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//         }
//     });
//     var login =  $("input[name=loginOsUpdate]").val();
//     var password = $("input[name=passwordUpdate]").val();
//     var TrueOrFalse = $('#TruOrfalseCombo').val();
//     var User_id = $("input[name=user_idMeaneger]").val();
//     var name = $("input[name=UpdMeanagerName]").val();
//     var phone = $("input[name=UpdMeanagerphone]").val();
//
//     // console.log(login, password, TrueOrFalse, User_id, name , phone)
//
//     $.ajax({
//         type:'POST',
//         url:URL+'UpdateMeaneger',
//         data:{login:login, password:password, TrueOrFalse:TrueOrFalse, user_id:User_id ,name:name, phone:phone},
//         success:function (response) {
//             if(response.status == false){
//                 $('.existEmail').css("border", "1px solid red");
//             }else{
//                 Swal.fire({
//                     position: 'center',
//                     icon: 'success',
//                     title: 'Datos del administrador actualizados',
//                     showConfirmButton: false,
//                     timer: 1000
//                 })
//
//                 setTimeout(function() {
//                     window.location.reload(true);
//                 }, 1000);
//             }
//         }
//
//     });
//
// });


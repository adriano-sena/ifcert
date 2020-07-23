/**
 * Ajax para criação das tags
 */


$(function () {
	$('#form').submit(function (event) {
		event.preventDefault();

		//Busque no formulario $this o valor do input com id = tag

		$.ajax({
			url: "/admin/tags/store",
			type: "post",
			data: $(this).serialize(),
			dataType: 'json',
			success: function (response) {

				if (response.success === true ) {
					let tag = response['tag'];
					let listItem = $('<li></li>').text(tag);
					$('#lista').append(listItem);
				}else{
					alert("Erro ! " + response.message);
				}


			}
		});

	});
});


// $(function(){
//     $('#form').submit(function(event){
//         event.preventDefault();
//         //Busque no formulario $this o valor do input com id = tag
//         var tag = $(this).find('input#tag').val();
//         var evento = $(this).find('input#evento-id').val();
//         alert("Evento" + evento + "tag: "+tag);

//     });
// });


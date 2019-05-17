$(document).ready(function(){
	/* Предотвращаем множественную отправку (флаг): */
	var working = false;

	/* Событие нажатия на кнопку: */
	$('#addReviewForm').submit(function(e){

		e.preventDefault();
		if(working) return false;

		working = true;
		$('#submit').val('Подождите..');
		$('span.error').remove();

		/* Отправляем поля в submit.php: */
		$.post('submit.php',$(this).serialize(),function(msg){

			working = false;
			$('#submit').val('Submit');

			if(msg.status){

				/*
				/	Если вставка прошла успешно, добавляем комментарий (со скольжением)
				/*/

				$(msg.html).hide().insertAfter('#addReviewContainer').slideDown();
				$('#text').val('');
			}
			else {

				/*
				/	Если была ошибка, проходим циклом по объекту
				/	msg.errors и выводим их на страницу
				/*/

				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},'json');

	});

});
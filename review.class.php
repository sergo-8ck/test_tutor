<?php

class Review
{
	private $data = array();

	public function __construct($row)
	{
		$this->data = $row;
	}

    /**
     * Вывод разметки
     *
     * @return string
     */
	public function markup()
	{
		// устанавливаем alias
		$d = &$this->data;
		
		// Конвертируем время в UNIX timestamp:
		$d['created_at'] = strtotime($d['created_at']);
		
		return '
			<div class="review">
				<div class="date" title="Добавлен '.date('H:i \o\n d M Y',$d['created_at']).'">'.date('d M Y - H:i',$d['created_at']).'</div>
				<p>Имя: '.$d['name'].'</p>
				<p>Отзыв: '.$d['text'].'</p>
			</div>
		';
	}

    /**
     * Валидация данных
     *
     * @param $arr
     *
     * @return bool
     */
    public static function validate(&$arr)
    {
        $errors = array();
        $data	= array();

        if(!($data['email'] = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)))
        {
            $errors['email'] = 'Пожалуйста введите правильный Email.';
        }

        if(!($data['text'] = filter_input(INPUT_POST,'text',FILTER_CALLBACK,array('options'=>'Review::validate_text'))))
        {
            $errors['text'] = 'Введите текст отзыва.';
        }

        if(!($data['name'] = filter_input(INPUT_POST,'name',FILTER_CALLBACK,array('options'=>'Review::validate_text'))))
        {
            $errors['name'] = 'Введите имя.';
        }

        if(!empty($errors)){

            // Если есть ошибки, копируем массив $errors в $arr:
            $arr = $errors;

            return false;
        }

        foreach($data as $k=>$v){
            $arr[$k] = $v;
        }

        // Приводим email к нижнему регистру
        $arr['email'] = strtolower(trim($arr['email']));

        return true;

    }

    /**
     *	Данный метод используется внутри как FILTER_CALLBACK
     *
     * @param $str
     *
     * @return bool|mixed|string
     */
    private static function validate_text($str)
    {
        if(mb_strlen($str,'utf8')<1)
            return false;

        // кодируем спецсимволы html (<, >, ", & .. etc) и конвертируем
        // переносы строк в тэги <br>:

        $str = nl2br(htmlspecialchars($str));

        // Удаляем оставшиеся переносы строк
        $str = str_replace(array(chr(10),chr(13)),'',$str);

        return $str;
    }
}

?>
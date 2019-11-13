<?php
//print_r ($_COOKIE);
//echo PHP_EOL . 'view';
if (isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang']=='ru') $language='ru';
    else  $language='en';
} else {
    $language='en';
}
echo 'language_selected' . PHP_EOL;
echo $language;

?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Выберите действие</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/form/views/defaultform.css"
    </head>
    <body>
	<script>
	    function validate(event){
		alert("ok");
		//event.preventDefault();
		//return false;
		return true;
	    }
	</script>
	<script>
	    function changeLanguage(selectedLanguage){
		if (selectedLanguage == 'English') document.cookie = "lang=en";
		else document.cookie = "lang=ru";
		document.location.reload();
		console.log(selectedLanguage);
	    }
	</script>

	<div class="language-select-container">
	    <select onchange="changeLanguage(this.options[this.selectedIndex].value)">
		<option <?php if ($language == 'en') echo 'selected '; ?> value="English"><?php echo config::$lang[$language]["defaultview"]["selected_language_en"]?></option>
		<option <?php if ($language == 'ru') echo 'selected '; ?> value="Russian"><?php echo config::$lang[$language]["defaultview"]["selected_language_ru"]?></option>
	    </select>
	</div>
	<div>Вход/Регистрация</div>
        <div class="form-container">
	    <form onsubmit="validate(event)" method="POST" action="/form/test.php">
		<label for"nikname"><? echo config::$lang[$language]["defaultview"]["register_form"]["nikname_label"]?></label>
		<input required type="text" id="nikname" name="nikname" oninvalid="this.setCustomValidity('Pole ne dolzhno bit pusto')">
		<label for"name">Ваше имя:</label>
		<input required type="text" id="name" name="nikname" oninvalid="this.setCustomValidity('Pole ne dolzhno bit pusto')">
		<label for"age">Ваше имя:</label>
		<input required type="text" id="age" name="nikname" oninvalid="this.setCustomValidity('Pole ne dolzhno bit pusto')">
		<label for"sex">Ваше имя:</label>
		<input required type="text" id="sex" name="nikname" oninvalid="this.setCustomValidity('Pole ne dolzhno bit pusto')">
        	<input type="submit" value="Добавить">
	    </form>
        </div>
    </body>
</html>


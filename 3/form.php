<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <title>Название страницы</title>
</head>

<body>
    <div class="form-container">
        <form method="POST" action="">
            <div class="input-group block">
                <input type="text" class="form-control" name="name" aria-describedby="basic-addon1"
                    placeholder="Ваше имя: KUJO JOTARO" />
            </div>
            <div class="input-group block">
                <input type="text" class="form-control" name="email" aria-describedby="basic-addon2"
                    placeholder="Ваше email: jojo@mail.com" />
            </div>
            <div class="block" id="date-block">
                <span class="block-title">Дата рождения</span>
                <input type="date" class="form-control" aria-describedby="basic-addon3" placeholder="example@mail.ru"
                    name="date" />
            </div>
            <div class="block" id="gender-block">
                <span class="block-title">Пол</span>
                <div class="radios">
                    <div class="male-radio">
                        <input class="form-check-input" type="radio" name="gender" value="m" />
                        <label class="form-check-label" for="male">Мужской</label>
                    </div>
                    <div class="female-radio">
                        <input class="form-check-input" type="radio" name="gender" value="f" />
                        <label class="form-check-label" for="female">Женский</label>
                    </div>
                </div>
            </div>
            <div class="block" id="limbs-block">
                <span class="block-title">Конечности</span>
                <div class="radios">
                    <div class="limbs-radio">
                        <input class="form-check-input" type="radio" name="limbs" value="1" />
                        <label class="form-check-label" for="male">1</label>
                    </div>
                    <div class="limbs-radio">
                        <input class="form-check-input" type="radio" name="limbs" value="2" />
                        <label class="form-check-label" for="female">2</label>
                    </div>
                    <div class="limbs-radio">
                        <input class="form-check-input" type="radio" name="limbs" value="3" />
                        <label class="form-check-label" for="female">3</label>
                    </div>
                    <div class="limbs-radio">
                        <input class="form-check-input" type="radio" name="limbs" value="4" />
                        <label class="form-check-label" for="female">4</label>
                    </div>
                </div>
            </div>
            <div class="block">
                <span class="block-title">Ваш Стэнд</span>
                <select class="form-select form-select-lg mb-2" name="select[]" multiple>
                    <option value="ora" selected>Star Platinum</option>
                    <option value="emerald splash">Hierophant Green</option>
                    <option value="sword">Silver Chariot</option>
                </select>
            </div>
            <div class="input-group">
                <textarea class="form-control" placeholder="Любимая фраза..." name="bio"></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" id="policy" name="policy" />
                <label class="form-check-label" for="policy">Согласен с <a href="./task3.html">политикой обработки
                    данных*</a>.</label>
            </div>
            <button class="btn btn-primary" type="submit" id="send-btn">Отправить</button>
        </form>
    </div>
</body>

</html>
Проект написан на чистом PHP+JS(Jquery), выучить Laravel не проблема если будет такая необходимость, об этом предупреждал с самого начала.

1) Структура проекта:
-- index.php (адаптивная верстка, все можно смотреть как на десктоп так и на смарт устройствах, таблица тоже адаптивная)
-- /app/script.php - скрипт для наполнения Базы данных, также отвечает за бекенд
-- Первое задание про погоду в Мурманске - раздел Погода в Мурманске


2) Запрашиваемые SQL запросы указаны в /views/v_indexbody.php - дублирую сюда

//  написать SQL запрос, в результате которого будет выведен список студентов, отстортированный по количеству просмотренный уроков.
SELECT users.login, users.name, users.fname, users.role, COUNT(lesson2user.id) AS total FROM users LEFT JOIN lesson2user ON users.login=lesson2user.user WHERE users.role='student' GROUP BY users.login ORDER BY total DESC

//  написать SQL запрос, в результате которого будет выведен список уроков, отсортированный по количеству студентов его посмотревших.
 SELECT lessons.id, lessons.lesson, COUNT(lesson2user.id) AS total FROM lessons LEFT JOIN lesson2user ON lessons.id=lesson2user.lessonid GROUP BY lessons.lesson ORDER BY total DESC

3) дамп базы данных в папке /db

1) Чтобы не писать новую функцию для подключения к БД использовал старые наработки

2) БД testa, выложена в db/, для примера

3) Вся логика в index.php 
3.1. Предусмотрел вывод статусов через echo для удобства (в реальной ситуации запуска скрипта по крону писалось бы в логи)
3.2. Предусмотрел изменения activity и duration пользователя в определенную дату
3.3. Учел ограничения на уникальность в таблице user_activity_cache
3.4. Много комментариев в коде не писал, не было времени, обычно пишу комментарии
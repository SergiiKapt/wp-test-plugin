

## Test task 

WordPress

Время выполнения 3 ч


- Поднять чистый WP.

- Установить плагин "ACF" (https://uk.wordpress.org/plugins/advanced-custom-fields/)

- Написать собственный плагин, который инициализирует новый post-type "Объект недвижимости" и taxonomy "Район".

- Через ACF создать набор полей для объектов недвижимости: "название дома (input)", "координаты местонахождения (input)", "количество этажей (1-20, list)", "тип строения (панель/кирпич/пеноблок, radio)"

- В single-page здания должны выводиться все эти заполненные атрибуты и прочее.

- В плагине добавить инициализацию shortcode и widget, который при вставке на фронте должен отобразить блок фильтра (со всем полями) по объектам недвижимости. При операции поиска ниже блока фильтра средствами Ajax должен выводиться список из 10 найденных позиций с постраничным выводом, по 3 на страницу. Каждая позиция содержит название района и все атрибуты.

- Решение загрузить на гитхаб, вместе с бд


## Solution

- install and activite plugin KSA Real Estate.
- add shortcode [property_filter] in page, post or widget content 

### Cmments

- The completion time was much longer than 3 hours
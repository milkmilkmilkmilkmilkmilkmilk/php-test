<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Кнопки</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        button {
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<button class="btn">1</button>
<button class="btn">2</button>
<button class="btn">3</button>

<script>
$(document).ready(function() {
    $('.btn').click(function() {
        let buttons = $('.btn');
        let order = buttons.map((_, btn) => $(btn).text()).get();
        
        // Смена порядка кнопок
        order.push(order.shift());
        
        buttons.each((index, btn) => {
            $(btn).text(order[index]);
        });
    });
});
</script>

</body>
</html>